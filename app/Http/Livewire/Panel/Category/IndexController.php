<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Domain\Post\Models\Post;
use Domain\Category\Models\Category;
use Domain\Service\Models\Service;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public $categoryByKey;
    public $category;

    public function mount()
    {
        $Categories = Category::with(['posts','services'])->orderBy('created_at', 'desc')->get();

        $this->category = $Categories;

        #dd($this->category);
    }

    public function checkDelete(Category $category)
    {
        $this->categoryByKey = $category;
        if((Auth::user()->level === 1) || (Auth::user()->level === 0)):
            
            $this->alert('question', 'Deletar Categoria', [
                'text' => 'Esta prestes a deletar a categoria '. 
                    $this->categoryByKey->title .' do sistema. Deletar?',
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
        if (($this->checkServiceByCategory() === false) || ($this->checkPostByCategory() === false))
        {
            $this->alert('warning', 'Não Pode Deletar', [
                'text' => 'Não pode deletar '. 
                    $this->categoryByKey->title .' do sistema, 
                    existem pelo menos 1 ou mais Posts ou Srviços 
                    relacionados a ela no sistema. Obrigado!',
                'position' => 'center',
                'toast' => false,
                'timer' => 10000,
                'timerProgressBar' => true,
            ]);
        }else{
            $this->categoryByKey->delete();
            $this->category->fresh();
            $this->alert('success', 'Sucesso', [
                'text' => 'Operação completamente bem sucedida!',
                'position' => 'center',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function checkServiceByCategory(): bool
    {
        $check = false;
        $checkCategory = Service::where('category_id', $this->categoryByKey->id)->count();
        if ($checkCategory === 0) $check = true;
        return (bool) $check;
    }

    public function checkPostByCategory(): bool
    {
        $check = false;
        $checkPost = Post::where('category_id', $this->categoryByKey->id)->count();
        if ($checkPost === 0) $check = true;
        return (bool) $check;
    }

    public function render()
    {
        return view('livewire.panel.category.index-controller')->layout('layouts.base');
    }
}
