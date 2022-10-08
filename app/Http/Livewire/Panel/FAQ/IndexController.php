<?php

namespace App\Http\Livewire\Panel\FAQ;

use Livewire\Component;
use Domain\FAQ\Models\FAQ;
use Domain\Service\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;
   
    protected $listeners = [
        'confirmed'
    ];

    public $FAQ;
    public $services;

    public function mount(FAQ $FAQ, Service $service)
    {
        $this->FAQ = $FAQ::with(['service','portfolio'])->orderBy('created_at', 'desc')->get();
        $this->services = $service::with(['FAQ'])->orderBy('created_at', 'desc')->get();
        #dd($this->FAQ[0]->category()->related['title']);
    }

    
    public function checkDelete(FAQ $FAQ)
    {
        $this->FAQByKey = $FAQ;
       
        $this->alert('question', 'Deletar FAQS', [
            'text' => 'Esta prestes a deletar o FAQS '. 
                $this->FAQByKey->question .' do sistema. Deletar?',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Deletar',
            'onConfirmed' => 'confirmed',
            'timer' => null,
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
        ]);
        
    }

    public function confirmed()
    {
        $this->FAQByKey->delete();
        $this->FAQ->fresh();
        $this->alert('success', 'Sucesso', [
            'text' => 'serviço deletado do sistema com sucesso!',
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.panel.f_a_q.index-controller')->layout('layouts.base');
    }
}
