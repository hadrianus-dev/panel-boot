<?php

namespace App\Http\Livewire\Panel\Team;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Team\Models\Team;
use Livewire\WithFileUploads;
use Domain\Team\Jobs\UpdateTeam;
use Domain\Team\Factory\TeamFactory;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{

    
    use WithFileUploads;
    use LivewireAlert;

    public $team;

    public $categories;

    public $cover;
    public $oldCover;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'team.full_name' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'team.email' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'team.phone_number' => [
            'required',
            'string',
            'min:3',
            'max:14',
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
            'nullable',
            'image',
            'mimes:jpg,jpeg,png',
        ],
    ];

    public function mount(Team $team)
    {
        $this->team = $team;
        
        #dd($this->oldCover);
        if($this->team['cover'] !== null):
            $this->oldCover = $this->team['cover'];
        endif;
        
    }

    public function update()
    {
        $data = $this->validate();

        #dd($data['team']);
        if($this->cover):
            $data['team']['cover'] = $this->setNameCover($data);
        else:
            $data['team']['cover'] = $this->team['cover'];
        endif;
        
        UpdateTeam::dispatch(
            Team: $this->team,
            object: TeamFactory::create(attributes: $data['team'])
        );
        if($this->cover):
            $this->ImageUpload();
        endif;
        
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
        $this->deleteOlldFiles();
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/team';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }
   

    private function deleteOlldFiles()
    {
        if($this->oldCovers):
            for ($i=0; $i < count($this->oldCovers); $i++) { 
                $cover = $this->oldCovers[$i]['cover'];
                Storage::disk('public')->delete($cover);
            }
        endif;
    }

    public function render()
    {
        return view('livewire.panel.team.update-controller')->layout('layouts.base');
    }
}
