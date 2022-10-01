<?php

namespace App\Http\Livewire\Panel\Team;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Team\Models\Team;
use Livewire\WithFileUploads;
use Domain\Team\Jobs\CreateTeam;
use Domain\Category\Models\Category;
use Domain\Team\Factory\TeamFactory;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $team;

    public $categories;

    public $cover;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'team.full_name' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:teams,full_name'
        ],
        'team.email' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:teams,email'
        ],
        'team.phone_number' => [
            'required',
            'string',
            'min:3',
            'max:14',
            'unique:teams,phone_number'
        ],
        'team.responsability' => [
            'required',
            'string',
            'min:3',
        ],
        'team.description' => [
            'nullable',
            'string',
        ],
        
        'team.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png',
        ],
    ];

    public function mount(Team $teams)
    {
        $this->team = $teams;
        #dd($this->team[5]);
    }

    public function submit()
    {
        $data = $this->validate();
        $data['team']['cover'] = $this->setNameCover($data);

        CreateTeam::dispatch(
            object: TeamFactory::create(attributes: $data['team'])
        );
        $this->ImageUpload();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        return redirect('team');
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['team']['full_name']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/team';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }
   
    public function ImageUpload(): void
    {
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/team';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }
    
    public function render()
    {
        return view('livewire.panel.team.store-controller')->layout('layouts.base');
    }
}
