<?php

namespace App\Http\Livewire\Panel\User;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Domain\Shared\Models\User;
use Domain\Shared\User\Jobs\UpdateUser;
use Domain\Shared\User\Factory\UserFactory;

class UpdateController extends Component
{
    use WithFileUploads;

    public $user;
    public $coverFullName;
    public $cover;
    public $oldCover;

    protected $rules = [
        'user.first_name' => [
            'string',
            'min:3',
            'max:100',
        ],
        'user.last_name' => [
            'string',
            'min:3',
            'max:100',
        ],
        'user.email' => [
            'email',
        ],
        'user.level' => [
            'integer',
        ],
        'cover' => [
            'image',
            'mimes:jpg,png',
        ]
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->oldCover = $user->cover;
    }

    
    public function update()
    {
        $data = $this->validate();
        $data['user']['password'] = $this->user->password;
        #dd($data);
        if($this->cover):
            $data['user']['cover'] = $this->setNameCover($data);
        else:
            $data['user']['cover'] = $this->user->cover;
        endif;
        #dd($data);
        UpdateUser::dispatch(
            user: $this->user,
            object: UserFactory::create(attributes: $data['user'])
        );

        if($this->cover):
            $this->ImageUpload();
        endif;

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
    }

    public function render()
    {
        return view('livewire.panel.user.update-controller')->layout('layouts.base');
    }
}
