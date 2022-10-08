<?php

namespace App\Http\Livewire\Panel\FAQ;

use Livewire\Component;
use Domain\FAQ\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use Domain\FAQ\Jobs\CreateFAQ;
use Domain\FAQ\Factory\FAQFactory;
use Domain\Service\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
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

    public function mount(FAQ $fAQ, Service $service)
    {
        $this->FAQ = $fAQ;
        $this->services = $service::orderBy('created_at', 'desc')->get();
    }

    public function submit()
    {
        $data = $this->validate()['FAQ'];
        #dd($data);
        CreateFAQ::dispatch(
            object: FAQFactory::create(attributes: $data)
        );

        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        
        return redirect('faq');
    }

    public function render()
    {
        return view('livewire.panel.f_a_q.store-controller')->layout('layouts.base');
    }
}
