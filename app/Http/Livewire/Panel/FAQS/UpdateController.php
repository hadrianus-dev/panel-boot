<?php

namespace App\Http\Livewire\Panel\FAQ;

use Domain\Category\Models\Category;
use Livewire\Component;
use Domain\FAQ\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use Domain\FAQ\Jobs\UpdateFAQ;
use Domain\FAQ\Factory\FAQFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use LivewireAlert;
    
    public $FAQ;
    public $allCategory;
    
    protected $rules = [
        'FAQ.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'FAQ.body' => [
            'required',
            'string',
            'min:3',
        ],
        'FAQ.description' => [
            'nullable',
            'string',
            'min:5',
        ],
        'FAQ.category_id' => [
            'nullable',
            'integer',
        ],
        'FAQ.published' => [
            'nullable',
            'boolean',
        ],
    ];

    protected $listeners = ['catEdit'];

    public function mount(FAQ $service)
    {
        $this->FAQ = $service;
        #dd($this->FAQ);
        $this->allCategory = Category::where('published', true)->get();
    }

    public function update()
    {
        $data = $this->validate()['FAQ'];
        #dd($this->FAQ);
        $data['description'] = (isset($data['description'])) 
        ? $data['description'] : null;
        $data['category_id'] = (isset($data['category_id'])) 
        ? (int) $data['category_id'] : $this->FAQ->category_id;
        $data['published'] = (isset($data['published'])) 
        ? (bool) $data['published'] : $this->FAQ->published;

        #dd($data);
        
        UpdateFAQ::dispatch(
            FAQ: $this->FAQ,
            object: FAQFactory::create(attributes: $data)
        );

        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        redirect('service');
    }

    public function filterChengeFAQById(){
        /* $this->FAQ['category_id'] = (isset($this->FAQ['parent'])) 
        ? (int) $this->FAQ['category_id'] : null; */
    }

    public function filterChengeStatus(){
        $this->FAQ['published'] = (isset($this->FAQ['published'])) 
        ? (int) $this->FAQ['published'] : false;
    }


    public function render()
    {
        return view('livewire.panel.service.update-controller')->layout('layouts.base');
    }
}
