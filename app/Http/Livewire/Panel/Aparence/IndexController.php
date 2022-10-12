<?php

namespace App\Http\Livewire\Panel\Aparence;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Aparence\Models\Aparence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class IndexController extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed',
        'refreshComponent' => '$refresh'
    ];

    public $aparenceByKey;

    public $aparence;

    public function mount(Aparence $aparence)
    {
        $this->aparence = $aparence::all();
        #dd($this->aparence);
    }

    public function checkDelete(Aparence $aparence)
    {
        $this->aparenceByKey = $aparence;
        
        $this->alert('question', 'Deletar Membro', [
            'text' => 'Esta prestes a deletar o membro '. 
                Str::upper($this->aparenceByKey->title) .' do sistema. Deletar?',
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
        $this->deleteOlldFiles();
        $this->aparenceByKey->delete();
        $this->aparence->fresh();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        #$this->emit('refreshComponent');
    }

    private function deleteOlldFiles()
    { 
        $cover =$this->aparenceByKey->cover;
        Storage::disk('public')->delete($cover);
    }

    public function render()
    {
        return view('livewire.panel.aparence.index-controller')->layout('layouts.base');
    }
}
