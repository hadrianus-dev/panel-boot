<?php

namespace App\Http\Livewire\Panel\User;

use Domain\Category\Models\Category;
use Domain\Post\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IndexController extends Component
{
    use LivewireAlert;
   
    protected $listeners = [
        'confirmed'
    ];

    public $userByKey;
    public $user;

    public function verifyDelete(User $user)
    {
        $this->userByKey = $user;
        if((Auth::user()->level === 1) || (Auth::user()->level === 0)):
            
            $this->alert('question', 'Deletar Usuário', [
                'text' => 'Esta prestes a deletar o usuário '. 
                    $this->userByKey->first_name .' do sistema. Deletar?',
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
            ]);
        endif;
    }

    public function confirmed()
    {
        if (($this->checkCategoryByUser() === false) || ($this->checkPostByUser() === false))
        {
            $this->alert('warning', 'Não Pode Deletar', [
                'text' => 'Não pode deletar '. 
                    $this->userByKey->first_name .' do sistema, 
                    existem pelo menos 1 ou mais Posts ou Categoria 
                    relacionados a ele no sistema. Obrigado!',
                'position' => 'center',
                'toast' => false,
                'timer' => 10000,
            ]);
        }else{
            $this->userByKey->delete();
            $this->user->fresh();
            $this->alert('success', 'Sucesso', [
                'text' => 'Usuário deletado do sistema com sucesso!'
            ]);
        }
    }

    public function checkCategoryByUser(): bool
    {
        $check = false;
        $checkCategory = Category::where('user_id', $this->userByKey->id)->count();
        if ($checkCategory === 0) $check = true;
        return (bool) $check;
    }

    public function checkPostByUser(): bool
    {
        $check = false;
        $checkPost = Post::where('user_id', $this->userByKey->id)->count();
        if ($checkPost === 0) $check = true;
        return (bool) $check;
    }

    public function mount(User $user)
    {
        $this->user = $user::all();
    }

    public function render()
    {
        return view('livewire.panel.user.index-controller')->layout('layouts.base');
    }
}
