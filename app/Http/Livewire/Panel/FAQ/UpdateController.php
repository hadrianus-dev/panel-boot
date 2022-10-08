<?php

namespace App\Http\Livewire\Panel\FAQ;

use Livewire\Component;
use Domain\FAQ\Models\FAQ;
use Domain\FAQ\Jobs\UpdateFAQ;
use Domain\FAQ\Factory\FAQFactory;
use Domain\Service\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use LivewireAlert;
    
    public $FAQ;
    public $services;
    
    protected $rules = [
        'FAQ.question' => [
            'required',
            'string',
            'min:3',
        ],
        'FAQ.response' => [
            'required',
            'string',
            'min:3',
        ],
        'FAQ.published' => [
            'nullable',
            'boolean',
        ],
        'FAQ.service_id' => [
            'nullable',
            'integer',
        ],
        'FAQ.portfolio_id' => [
            'nullable',
            'integer',
        ],
    ];

    public function mount(FAQ $FAQ, Service $service): void
    {
        $this->FAQ = $FAQ;
        #dd($this->FAQ);
        $this->services = $service::orderBy('created_at', 'desc')->get();
    }

    public function update()
    {
        $data = $this->validate()['FAQ'];
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
        redirect('faq');
    }

    public function render()
    {
        return view('livewire.panel.f_a_q.update-controller')->layout('layouts.base');
    }
}
