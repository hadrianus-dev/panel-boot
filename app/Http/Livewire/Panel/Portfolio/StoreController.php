<?php

namespace App\Http\Livewire\Panel\Portfolio;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Domain\Gallery\Models\Gallery;
use Domain\Service\Models\Service;
use Domain\Gallery\Jobs\CreateGallery;
use Domain\Portfolio\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Domain\Gallery\Factory\GalleryFactory;
use Domain\Portfolio\Jobs\CreatePortfolio;
use Domain\Portfolio\Factory\PortfolioFactory;

class StoreController extends Component
{
    use WithFileUploads;

    public $portfolio;
    public $Data;

    public $gallery;
    public $services;

    public $cover = [];
    public $covers = [];
    private $coverFullName;
    
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
            'max:120',
        ],
        'portfolio.date_start' => [
            'required',
            'date',
            'max:120',
        ],
        'portfolio.date_finish' => [
            'nullable',
            'date',
            'max:120',
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
        return date('Y-m-d',$time);
    }

    public function submit()
    {
        $data = $this->validate();

        $this->Data = $data['portfolio'];

        CreatePortfolio::dispatch(
            object: PortfolioFactory::create(attributes: $this->Data)
        );
        $this->UploadAtualGallery();
        $this->UploadOldGallery();
        return redirect('portfolio');
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
            'portfolio_id' => $this->portfolio['id'],
            'status' => $status,
            'cover' => $path
        ];

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
