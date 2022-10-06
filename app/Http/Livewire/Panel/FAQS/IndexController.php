<?php

namespace App\Http\Livewire\Panel\FAQ;

use Domain\Portfolio\Models\Portfolio;
use Livewire\Component;
use Domain\FAQ\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;
   
    protected $listeners = [
        'confirmed'
    ];

    public $services;

    public function mount(FAQ $service)
    {
        $this->services = $service::with(['category','portfolio'])->orderBy('created_at', 'desc')->get();
        #dd($this->services[0]->category()->related['title']);
    }

    
    public function checkDelete(FAQ $service)
    {
        $this->serviceByKey = $service;
        if((Auth::user()->level === 1) || (Auth::user()->level === 0)):
            
            $this->alert('question', 'Deletar serviço', [
                'text' => 'Esta prestes a deletar o serviço '. 
                    $this->serviceByKey->title .' do sistema. Deletar?',
                'position' => 'center',
                'toast' => true,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Deletar',
                'onConfirmed' => 'confirmed',
                'timer' => null,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
            ]);
        else:
            $this->alert('warning', 'Permissão Negada.', [
                'text' => 'Você não tem permissão para executar esta ação. Obrigado!',
                'position' => 'center',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        endif;
    }

    public function confirmed()
    {
        if (($this->checkPortfolioByFAQ() === false))
        {
            $this->alert('warning', 'Não Pode Deletar', [
                'text' => 'Não pode deletar '. 
                    $this->serviceByKey->title .' do sistema, 
                    existem pelo menos 1 ou mais Posts ou Categoria 
                    relacionados a ele no sistema. Obrigado!',
                'position' => 'center',
                'toast' => false,
                'timer' => 10000,
                'timerProgressBar' => true,
            ]);
        }else{
            $this->serviceByKey->delete();
            $this->services->fresh();
            $this->alert('success', 'Sucesso', [
                'text' => 'serviço deletado do sistema com sucesso!',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function checkPortfolioByFAQ(): bool
    {
        $check = false;
        $checkCategory = Portfolio::where('service_id', $this->serviceByKey->id)->count();
        if ($checkCategory === 0) $check = true;
        return (bool) $check;
    }

    public function render()
    {
        return view('livewire.panel.service.index-controller')->layout('layouts.base');
    }
}
