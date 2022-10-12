<?php

namespace App\Http\Livewire\Panel\Aparence;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Aparence\Models\Aparence;
use Livewire\WithFileUploads;
use Domain\Aparence\Jobs\CreateAparence;
use Domain\Category\Models\Category;
use Domain\Aparence\Factory\AparenceFactory;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $aparence;

    public $categories;

    public $cover;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'aparence.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:aparences,title'
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

    public function mount(Aparence $aparences)
    {
        $this->aparence = $aparences;
        #dd($this->aparence[5]);
    }

    public function submit()
    {
        $data = $this->validate();
        $data['aparence']['cover'] = $this->setNameCover($data);

        CreateAparence::dispatch(
            object: AparenceFactory::create(attributes: $data['aparence'])
        );

        $this->ImageUpload();
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
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/aparence';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }
    
    public function render()
    {
        return view('livewire.panel.aparence.store-controller')->layout('layouts.base');
    }
}
