<?php

namespace App\Http\Livewire\Panel\Auth;

use Livewire\Component;
use Domain\Shared\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LoginController extends Component
{
    
    public array $form = [
        'email', 'password'
    ];

    protected $rules = [
        'form.email' => 'required|email',
        'form.password' => 'required|string|min:4|max:14',
    ];

    public function login()
    { 
            $this->validate();

            $data['email'] = $this->form['email'];
            $data['password'] = $this->form['password'];
        
            if(!Auth::attempt($data)){
                $this->form['message'] = 'Algo errado, tente novamente';
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
   
            $user = User::where('email', $this->form['email'])->first();
            
            return redirect(route('dashboard'));

    
    }

    public function render()
    {
        return view('livewire.panel.auth.login-controller')->layout('layouts.guest');
    }
}
