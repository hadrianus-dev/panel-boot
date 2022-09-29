<?php

namespace App\Http\Livewire\Panel\Service;

use Livewire\Component;
use Domain\Service\Models\Service;
use Illuminate\Support\Facades\Auth;
use Domain\Service\Jobs\UpdateService;
use Domain\Service\Factory\ServiceFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use LivewireAlert;
    
    public $serviceData;
    public $allCategory;

    public $data = [
        'title',
        'body',
        'description',
        'published',
        'category_id'
    ];
    
    protected $rules = [
        'data.title' => [
            'required',
            'string',
            'min:3',
            'max:255'
        ],
        'data.body' => [
            'required',
            'string',
            'min:3',
        ],
        'data.description' => [
            'nullable',
            'string',
            'max:120',
        ],
        'data.category_id' => [
            'nullable',
            'integer',
        ],
        'data.published' => [
            'nullable',
            'boolean',
        ],
    ];

    protected $listeners = ['catEdit'];

    public function catEdit($id){
        dd($id);
    }

    public function mount($service)
    {
        $this->serviceData = Service::where('key', $service)->first();
        #dd($this->serviceData);
        $this->data = [
            'title' => $this->serviceData['title'],
            'body' => $this->serviceData->body,
            'description' => $this->serviceData->description,
        ]; 
        #dd($this->data);
        $this->allCategory = new Service;
    }

    public function update()
    {
        $this->validate();
        #dd($this->data);
        $this->data['description'] = (isset($this->data['description'])) 
        ? $this->data['description'] : null;
        $this->data['category_id'] = (isset($this->data['category_id'])) 
        ? (int) $this->data['category_id'] : null;
        $this->data['published'] = (isset($this->data['published'])) 
        ? (int) $this->data['published'] : false;
        #dd($this->data);
        UpdateService::dispatch(
            Service: $this->serviceData,
            object: ServiceFactory::create(attributes: $this->data)
        );

        $this->serviceData->fresh();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        redirect('service');
    }

    public function filterChengeServiceById(){
        /* $this->data['category_id'] = (isset($this->data['parent'])) 
        ? (int) $this->data['category_id'] : null; */
    }

    public function filterChengeStatus(){
        $this->data['published'] = (isset($this->data['published'])) 
        ? (int) $this->data['published'] : false;
    }


    public function render()
    {
        return view('livewire.panel.service.update-controller')->layout('layouts.base');
    }
}
