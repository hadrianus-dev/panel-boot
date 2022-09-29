<?php

namespace App\Http\Livewire\Panel\Enterprise;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Enterprise\Models\Enterprise;
use Livewire\WithFileUploads;
use Domain\Enterprise\Jobs\UpdateEnterprise;
use Domain\Enterprise\Factory\EnterpriseFactory;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $enterprise;

    public $categories;

    public $oldCover;
    public $oldCovers;

    public $cover;
    public $covers;
    private $coverFullName;
    private $logoFullName;
    
    protected $rules = [
        'enterprise.title' => [
            'string',
            'min:3',
            'max:255',
        ],
        'enterprise.body' => [
            'string',
            'min:3',
        ],
        'enterprise.description' => [
            'nullable',
            'string',
        ],
        'enterprise.slogan' => [
            'nullable',
            'string',
        ],
        'enterprise.mission' => [
            'nullable',
            'string',
        ],
        'enterprise.vision' => [
            'nullable',
            'string',
        ],
        'enterprise.value'  => [
            'nullable',
            'string',
        ],
        'enterprise.general_email' => [
            'email',
            'string',
        ],
        'enterprise.comercial_email'=> [
            'email',
            'string',
        ],
        'enterprise.general_phone' => [
            'nullable',
            'string',
        ],
        'enterprise.comercial_phone' => [
            'nullable',
            'string',
        ],
        'enterprise.founder' => [
            'nullable',
            'string',
            'min:3',
        ],
        'enterprise.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'nullable',
            'image',
            'mimes:jpg,png',
        ],
        'covers' => [
            'nullable',
            'image',
            'mimes:jpg,png',
        ],
    ];

    public function mount(Enterprise $enterprise)
    {
        $this->enterprise = $enterprise;
        $this->oldCover = $this->enterprise->logo;
        #dd($this->oldCover);
        $this->oldCovers = $this->enterprise->cover;
    }

    public function submit()
    {
        $data = $this->validate();
        #dd($data['enterprise']);
        if($this->covers):
            $data['enterprise']['cover'] = $this->setNameCover($data);
        else:
            $data['enterprise']['cover'] = $this->enterprise->cover;
        endif;
        if($this->cover):
            $data['enterprise']['logo'] = $this->setNameLogo($data);
        else:
            $data['enterprise']['logo'] = $this->enterprise->cover;
        endif;

        UpdateEnterprise::dispatch(
            Enterprise: $this->enterprise,
            object: EnterpriseFactory::create(attributes: $data['enterprise'])
        );

        if($this->cover):
            $this->logoUpload();
        endif;
        if($this->covers):
            $this->coverUpload();
        endif;
        
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        return redirect('enterprise');
    }

    private function setNameLogo($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['enterprise']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/enterprise';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->logoFullName = $ImageFullName;
        return $theImagePath;
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['covers']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['enterprise']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/enterprise';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }

    public function logoUpload(): void
    {
        $image = $this->validate([
            'cover' => 'nullable'
        ]);
        if($this->cover):
            $this->deleteOlldFiles($this->cover);
        endif;
        $mountPathImage = 'images/enterprise';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->logoFullName);
    }
   
    public function coverUpload(): void
    {
        $image = $this->validate([
            'covers' => 'nullable'
        ]);
        if($this->covers):
        $this->deleteOlldFiles($this->covers);
        endif;
        $mountPathImage = 'images/enterprise';  
        $image['covers']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }


    private function deleteOlldFiles($old)
    {
        if($old):
            Storage::disk('public')->delete($old);
        endif;
    }

    public function render()
    {
        return view('livewire.panel.enterprise.update-controller')->layout('layouts.base');
    }
}
