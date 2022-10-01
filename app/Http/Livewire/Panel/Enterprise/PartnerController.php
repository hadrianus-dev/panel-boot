<?php

namespace App\Http\Livewire\Panel\Enterprise;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Partner\Models\Partner;
use Livewire\WithFileUploads;
use Domain\Partner\Jobs\CreatePartner;
use Domain\Category\Models\Category;
use Domain\Partner\Factory\PartnerFactory;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PartnerController extends Component
{

    
    use WithFileUploads;
    use LivewireAlert;

    public $partner;

    public $cover;
    private $coverFullName;
    
    protected $rules = [
        'partner.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:partners,title'
        ],
        'partner.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png',
        ],
    ];

    public function mount(Partner $partners)
    {
        $this->partner = $partners;
        #dd($this->partner[5]);
    }

    public function submit()
    {
        $data = $this->validate();
        $data['partner']['cover'] = $this->setNameCover($data);

        CreatePartner::dispatch(
            object: PartnerFactory::create(attributes: $data['partner'])
        );
        $this->ImageUpload();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        return redirect('enterprise');
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['partner']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/partner';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }
   
    public function ImageUpload(): void
    {
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/partner';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }

    public function render()
    {
        return view('livewire.panel.enterprise.partner-controller')->layout('layouts.base');
    }
}
