<?php

namespace App\Http\Livewire\Panel\Enterprise;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Enterprise\Models\Enterprise;
use Livewire\WithFileUploads;
use Domain\Enterprise\Jobs\CreateEnterprise;
use Domain\Enterprise\Factory\EnterpriseFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $enterprise;

    public $categories;

    public $cover;
    public $covers;
    private $coverFullName;
    private $logoFullName;
    
    protected $rules = [
        'enterprise.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:enterprises,title'
        ],
        'enterprise.body' => [
            'required',
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
            'required',
            'image',
            'mimes:jpg,png',
        ],
        'covers' => [
            'nullable',
            'image',
            'mimes:jpg,png',
        ],
    ];

    public function mount(Enterprise $enterprises)
    {
        $this->enterprise = $enterprises;
        #dd($this->enterprise[5]);
    }

    public function submit()
    {
        $data = $this->validate();
        $data['enterprise']['logo'] = $this->setNameLogo($data);
        if($this->covers):
            $data['enterprise']['cover'] = $this->setNameCover($data);
        endif;
        #dd($data['enterprise']);
        CreateEnterprise::dispatch(
            object: EnterpriseFactory::create(attributes: $data['enterprise'])
        );

        $this->logoUpload();
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
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['enterprise']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/enterprise';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }
   
    public function logoUpload(): void
    {
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/enterprise';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->logoFullName);
    }
   
    public function coverUpload(): void
    {
        $image = $this->validate([
            'covers' => 'image|required'
        ]);
        $mountPathImage = 'images/enterprise';  
        $image['covers']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }

    public function render()
    {
        return view('livewire.panel.enterprise.store-controller')->layout('layouts.base');
    }
}
