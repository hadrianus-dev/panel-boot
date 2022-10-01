<?php

namespace App\Http\Livewire\Panel\Service;

use Domain\Category\Models\Category;
use Livewire\Component;
use Domain\Service\Models\Service;
use Illuminate\Support\Facades\Auth;
use Domain\Service\Jobs\UpdateService;
use Domain\Service\Factory\ServiceFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use LivewireAlert;
    
    public $Service;
    public $allCategory;
    
    protected $rules = [
        'Service.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'Service.body' => [
            'required',
            'string',
            'min:3',
        ],
        'Service.description' => [
            'nullable',
            'string',
            'min:5',
        ],
        'Service.category_id' => [
            'nullable',
            'integer',
        ],
        'Service.published' => [
            'nullable',
            'boolean',
        ],
    ];

    protected $listeners = ['catEdit'];

    public function mount(Service $service)
    {
        $this->Service = $service;
        #dd($this->Service);
        $this->allCategory = Category::where('published', true)->get();
    }

    public function update()
    {
        $data = $this->validate()['Service'];
        #dd($this->Service);
        $data['description'] = (isset($data['description'])) 
        ? $data['description'] : null;
        $data['category_id'] = (isset($data['category_id'])) 
        ? (int) $data['category_id'] : $this->Service->category_id;
        $data['published'] = (isset($data['published'])) 
        ? (bool) $data['published'] : $this->Service->published;

        #dd($data);
        
        UpdateService::dispatch(
            Service: $this->Service,
            object: ServiceFactory::create(attributes: $data)
        );

        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        redirect('service');
    }

    public function filterChengeServiceById(){
        /* $this->Service['category_id'] = (isset($this->Service['parent'])) 
        ? (int) $this->Service['category_id'] : null; */
    }

    public function filterChengeStatus(){
        $this->Service['published'] = (isset($this->Service['published'])) 
        ? (int) $this->Service['published'] : false;
    }


    public function render()
    {
        return view('livewire.panel.service.update-controller')->layout('layouts.base');
    }
}
