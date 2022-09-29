<?php

namespace App\Http\Livewire\Panel\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Post\Models\Post;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed',
        'refreshComponent' => '$refresh'
    ];

    public $postByKey;

    public $post;

    public function mount()
    {
        $posts = Post::with(['gallery','category','user'])->orderBy('created_at', 'desc')->get();
        
        $this->post = $posts;
        #dd($this->post);
    }

    public function checkDelete(Post $post)
    {
        $this->postByKey = $post;
        
        $this->alert('question', 'Deletar Portifolio', [
            'text' => 'Esta prestes a deletar o post '. 
                Str::ucfirst($this->postByKey->title) .' do sistema. Deletar?',
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
        $this->postByKey->delete();
        $this->post->fresh();
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
        $this->alert('warning', 'Apagando', [
            'text' => 'Apagando arquivos relacionados!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        $oldCovers = $this->postByKey->gallery()->get();
        $count = $this->postByKey->gallery()->count();
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
        return view('livewire.panel.post.index-controller')->layout('layouts.base');
    }
}
