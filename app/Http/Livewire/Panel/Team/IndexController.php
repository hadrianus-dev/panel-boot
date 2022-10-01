<?php

namespace App\Http\Livewire\Panel\Team;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Team\Models\Team;
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

    public $teamByKey;

    public $team;

    public function mount(Team $team)
    {
        $this->team = $team::all();
        #dd($this->team);
    }

    public function checkDelete(Team $team)
    {
        $this->teamByKey = $team;
        
        $this->alert('question', 'Deletar Membro', [
            'text' => 'Esta prestes a deletar o membro '. 
                Str::upper($this->teamByKey->full_name) .' do sistema. Deletar?',
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
        $this->teamByKey->delete();
        $this->team->fresh();
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
        $cover =$this->teamByKey->cover;
        Storage::disk('public')->delete($cover);
    }

    public function render()
    {
        return view('livewire.panel.team.index-controller')->layout('layouts.base');
    }
}
