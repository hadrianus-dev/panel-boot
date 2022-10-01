<?php

namespace App\Http\Livewire\Panel\Portfolio;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Portfolio\Models\Portfolio;
use Livewire\WithFileUploads;
use Domain\Portfolio\Jobs\UpdatePortfolio;
use Domain\Gallery\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Domain\Service\Models\Service;
use Domain\Portfolio\Factory\PortfolioFactory;
use Illuminate\Support\Facades\Auth;
use Domain\Gallery\Jobs\CreateGallery;
use Illuminate\Support\Facades\Storage;
use Domain\Gallery\Factory\GalleryFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $portfolio;

    public $services;

    public $cover;
    public $oldCover;
    public $oldCovers;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'portfolio.title' => [
            'nullable',
            'string',
            'min:3',
            'max:255',
        ],
        'portfolio.body' => [
            'nullable',
            'string',
            'min:3',
        ],
        'portfolio.description' => [
            'nullable',
            'string',
        ],
        'portfolio.date_start' => [
            'nullable',
            'date',
        ],
        'portfolio.date_finish' => [
            'nullable',
            'date',
        ],
        'portfolio.service_id' => [
            'nullable',
            'integer',
        ],
        'portfolio.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'nullable',
            'array',
        ],
        'covers' => [
            'nullable',
            'array',
        ],
    ];

    public function mount(Service $services, Gallery $gallery, Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->oldCovers = $gallery::where([
            ['portfolio_id', $portfolio->id],
            ['status', false]
            ])->get();
        $this->oldCover = $gallery::where([
            ['portfolio_id', $portfolio->id],
            ['status', true]
            ])->get();
    
        $this->services = $services->where('published', true)->get();
    }

    public function update()
    {
        $data = $this->validate();
        #dd($data['portfolio']);
        UpdatePortfolio::dispatch(
            Portfolio: $this->portfolio,
            object: PortfolioFactory::create(attributes: $data['portfolio'])
        );

        if($this->cover):
            $this->UploadAtualGallery();
        endif;
        if($this->covers):
            $this->UploadOldGallery();
        endif;

        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);

        return redirect('portfolio');
    }

    
    public function UploadAtualGallery(): void
    {
        $images = $this->validate([
            'cover' => 'nullable'
        ]);
        
        if($this->cover):
            $this->deleteOlldFiles($this->oldCover);
            foreach($images['cover'] as $image):
                #dd($image);
                $getExtension = $image->getClientOriginalExtension(); 
                $ImageFullName = Str::slug($this->portfolio['title']) .'-'. uniqid().'.'. $getExtension;
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
            $this->deleteOlldFiles($this->oldCovers);
            foreach($images['covers'] as $image):
                #dd($image);
                $getExtension = $image->getClientOriginalExtension(); 
                $ImageFullName = Str::slug($this->portfolio['title']) .'-'. uniqid().'.'. $getExtension;
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

    private function deleteOlldFiles($oldCovers)
    {
        if($oldCovers):
            for ($i=0; $i < count($oldCovers); $i++) { 
                $cover = $oldCovers[$i]['cover'];
                Storage::disk('public')->delete($cover);
                DB::table('galleries')->where('cover', $cover)->delete();
            }
        endif;
    }

    public function render()
    {
        return view('livewire.panel.portfolio.update-controller')->layout('layouts.base');
    }
}
