<?php

namespace App\Http\Livewire\Panel\Portfolio;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Domain\Portfolio\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public $portfolioByKey;
    public $portfolio;

    public function mount()
    {
        $portfolios = Portfolio::with(['service','gallery'])->orderBy('created_at', 'desc')->get();
        
        $this->portfolio = $portfolios;
        #dd($this->portfolio);
    }

    public function checkDelete(Portfolio $portfolio)
    {
        $this->portfolioByKey = $portfolio;
        
        $this->alert('question', 'Deletar Portifolio', [
            'text' => 'Esta prestes a deletar o portifolio '. 
                Str::ucfirst($this->portfolioByKey->title) .' do sistema. Deletar?',
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
        $this->portfolioByKey->delete();
        $this->portfolio->fresh();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);

    }

    private function deleteOlldFiles()
    {   
        $this->alert('warning', 'Apagando', [
            'text' => 'Apagando arquivos relacionados!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        $oldCovers = $this->portfolioByKey->gallery()->get();
        $count = $this->portfolioByKey->gallery()->count();
        if($oldCovers):
            for ($i=0; $i < $count; $i++) { 
                $cover = $oldCovers[$i]['cover'];
                Storage::disk('public')->delete($cover);
                DB::table('galleries')->where('cover', $cover)->delete();
            }
        endif;
    }


    public function render()
    {
        return view('livewire.panel.portfolio.index-controller')->layout('layouts.base');
    }
}
