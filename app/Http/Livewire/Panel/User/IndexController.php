<?php

namespace App\Http\Livewire\Panel\User;

use Domain\Shared\Models\User;
use Livewire\Component;

class IndexController extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user::all();
    }

    public function render()
    {
        return view('livewire.panel.user.index-controller')->layout('layouts.base');
    }
}
