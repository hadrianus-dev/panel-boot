<?php

namespace App\Http\Livewire\Panel\Portfolio;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Domain\Gallery\Models\Gallery;
use Domain\Service\Models\Service;
use Domain\Gallery\Jobs\CreateGallery;
use Domain\Portfolio\Models\Portfolio;
use Domain\Gallery\Factory\GalleryFactory;
use Domain\Portfolio\Jobs\CreatePortfolio;
use Domain\Portfolio\Factory\PortfolioFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $portfolio;
    public $Data;

    public $gallery;
    public $services;

    public $image;
    public $cover = [];
    public $covers = [];
    private $coverFullName;
    private $imageFullName;
    
    protected $rules = [
        'portfolio.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:portfolios,title'
        ],
        'portfolio.body' => [
            'required',
            'string',
            'min:3',
        ],
        'portfolio.description' => [
            'nullable',
            'string',
            'min:3',
        ],
        'portfolio.date_start' => [
            'required',
            'date',
        ],
        'portfolio.date_finish' => [
            'nullable',
            'date',
        ],
        'portfolio.client' => [
            'nullable',
            'string',
        ],
        'portfolio.external_link' => [
            'nullable',
            'url',
        ],
        'portfolio.local' => [
            'nullable',
            'string',
        ],
        'portfolio.service_id' => [
            'required',
            'integer',
        ],
        'portfolio.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'required',
            'array',
        ],
        'covers' => [
            'nullable',
            'array',
        ],
        'image' => [
            'nullable',
            'image',
        ],
    ];

    public function mount(Service $service, Gallery $gallery, Portfolio $portfolios)
    {
        $this->gallery = $gallery;
        $this->portfolio = $portfolios;
        #dd($this->portfolio[5]);
        $this->services = $service::where('published', true)->get();
    }
     
    private function newDate($date)
    {
        $time = strtotime($date);
        return date('Y-m-d', $time);
    }

    public function submit()
    {
        $data = $this->validate();
        $this->Data = $data['portfolio'];
        $this->Data['cover'] = null;

        if($this->image){
            $this->Data['cover'] = $this->setNameCover($data);
        }

        CreatePortfolio::dispatch(
            object: PortfolioFactory::create(attributes: $this->Data)
        );

        if($this->image){
            $this->ImageUpload();
        }
        
        if($this->cover):
        $this->UploadAtualGallery();
        endif;
        if($this->covers):
        $this->UploadOldGallery();
        endif;
        
        $this->alert('success', 'Sucesso', [
            'text' => 'Opera????o completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);

        return redirect('portfolio');
    }

    private function setNameCover($data): string
    {
        $getExtension = $this->image->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['portfolio']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/portfolios';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->imageFullName = $ImageFullName;
        return $theImagePath;
    }

    public function ImageUpload(): void
    {
        $image = $this->validate([
            'image' => 'image|required'
        ]);
        $mountPathImage = 'images/portfolios';  
        $image['image']->storeAs('public/'.$mountPathImage, $this->imageFullName);
    }

    public function UploadAtualGallery(): void
    {
        $images = $this->validate([
            'cover' => 'nullable'
        ]);
        
        if($this->cover):
            foreach($images['cover'] as $image):
                #dd($image);
                $getExtension = $image->getClientOriginalExtension(); 
                $ImageFullName = Str::slug($this->Data['title']) .'-'. uniqid().'.'. $getExtension;
                $mountPathImage = 'images/portfolios';  
                $theImagePath = $mountPathImage.'/'.$ImageFullName;
                $this->setGallery($theImagePath, true);
                $image->storeAs('public/'.$mountPathImage, $ImageFullName);
            endforeach;
        endif;
    }

    public function UploadOldGallery(): void
    {
        $images = $this->validate([
            'covers' => 'nullable'
        ]);
        
        if($this->covers):
            foreach($images['covers'] as $image):
                #dd($image);
                $getExtension = $image->getClientOriginalExtension(); 
                $ImageFullName = Str::slug($this->Data['title']) .'-'. uniqid().'.'. $getExtension;
                $mountPathImage = 'images/portfolios';  
                $theImagePath = $mountPathImage.'/'.$ImageFullName;
                $this->setGallery($theImagePath, false);
                $image->storeAs('public/'.$mountPathImage, $ImageFullName);
            endforeach;
        endif;
    }

    private function setGallery($path, bool $status): bool
    {
        $data = [
            'published' => true,
            'portfolio_id' => (int) $this->portfolio::where('slug', Str::slug($this->Data['title']))->first()['id'],
            'status' => $status,
            'cover' => $path
        ];
        #dd($data);
        CreateGallery::dispatch(
            GalleryFactory::create($data)
        );

        return true;
    }

    public function render()
    {
        return view('livewire.panel.portfolio.store-controller')->layout('layouts.base');
    }
}
