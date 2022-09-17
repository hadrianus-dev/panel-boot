<?php

namespace App\Http\Livewire\Panel\Auth;

use Livewire\Component;

class LoginController extends Component
{
    public function render()
    {
        return view('livewire.panel.auth.login-controller')->layout('layouts.guest');
    }
}
