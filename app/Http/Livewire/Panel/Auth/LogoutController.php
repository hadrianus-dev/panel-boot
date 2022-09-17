<?php

namespace App\Http\Livewire\Panel\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutController extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function render()
    {
        return view('livewire.panel.auth.logout-controller');
    }
}
