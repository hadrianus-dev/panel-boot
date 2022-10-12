<?php

namespace App\Http\Livewire\Panel\Aparence;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Aparence\Models\Aparence;
use Livewire\WithFileUploads;
use Domain\Aparence\Jobs\UpdateAparence;
use Domain\Aparence\Factory\AparenceFactory;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{

    
    use WithFileUploads;
    use LivewireAlert;

    public $aparence;

    public $categories;

    public $cover;
    public $oldCover;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'aparence.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'aparence.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png',
        ],
    ];

    public function mount(Aparence $aparence)
    {
        $this->aparence = $aparence;
        
        #dd($this->oldCover);
        if($this->aparence['cover'] !== null):
            $this->oldCover = $this->aparence['cover'];
        endif;
        
    }

    public function update()
    {
        $data = $this->validate();

        #dd($data['aparence']);
        if($this->cover):
            $data['aparence']['cover'] = $this->setNameCover($data);
        else:
            $data['aparence']['cover'] = $this->aparence['cover'];
        endif;
        
        UpdateAparence::dispatch(
            Aparence: $this->aparence,
            object: AparenceFactory::create(attributes: $data['aparence'])
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
        return redirect('aparence');
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['aparence']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/aparence';  
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
        $mountPathImage = 'images/aparence';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }
   

    private function deleteOlldFiles()
    {
        if($this->oldCover):
            Storage::disk('public')->delete($this->oldCover);
        endif;
    }

    public function render()
    {
        return view('livewire.panel.aparence.update-controller')->layout('layouts.base');
    }
}
