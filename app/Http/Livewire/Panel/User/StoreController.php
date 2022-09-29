<?php

namespace App\Http\Livewire\Panel\User;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Domain\Shared\Models\User;
use Domain\Shared\User\Jobs\CreateUser;
use Domain\Shared\User\Factory\UserFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $user;
    public $coverFullName;
    public $cover;

    protected $rules = [
        'user.first_name' => [
            'required',
            'string',
            'min:3',
            'max:100',
        ],
        'user.last_name' => [
            'required',
            'string',
            'min:3',
            'max:100',
        ],
        'user.email' => [
            'required',
            'email',
            'unique:users,email'
        ],
        'user.level' => [
            'required',
            'integer',
        ],
        'cover' => [
            'required',
            'image',
            'mimes:jpg,png',
        ]
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    
    public function submit()
    {
        $data = $this->validate();
        $data['user']['password'] = 'password';
        
        if($this->cover):
            $data['user']['cover'] = $this->setNameCover($data);
        endif;
        #dd($data);
        CreateUser::dispatch(
            object: UserFactory::create(attributes: $data['user'])
        );

        $this->alert('success', 'Sucesso', [
            'text' => 'Cadastro bem sucedido!'
        ]);
        $this->ImageUpload();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        return redirect('user');
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['user']['last_name']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/users';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }
   
    public function ImageUpload(): void
    {
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/users';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
        $this->alert('success', 'Sucesso', [
            'text' => 'Upload de imagem bem sucedido!'
        ]);
    }

    public function render()
    {
        return view('livewire.panel.user.store-controller')->layout('layouts.base');
    }
}
