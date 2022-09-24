<?php

namespace App\Http\Livewire\Panel\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Post\Models\Post;
use Livewire\WithFileUploads;
use Domain\Post\Jobs\UpdatePost;
use Domain\Gallery\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Domain\Category\Models\Category;
use Domain\Post\Factory\PostFactory;
use Illuminate\Support\Facades\Auth;
use Domain\Gallery\Jobs\CreateGallery;
use Illuminate\Support\Facades\Storage;
use Domain\Gallery\Factory\GalleryFactory;

class UpdateController extends Component
{
    use WithFileUploads;

    public $post;

    public $categories;

    public $cover;
    public $oldCover;
    public $oldCovers;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'post.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
        ],
        'post.body' => [
            'required',
            'string',
            'min:3',
        ],
        'post.description' => [
            'nullable',
            'string',
            'max:120',
        ],
        'post.category_id' => [
            'nullable',
            'integer',
        ],
        'post.published' => [
            'nullable',
            'boolean',
        ],
        'cover' => [
            'nullable',
        ],
        'covers' => [
            'nullable',
        ],
    ];

    public function mount(Category $modelPost, Gallery $gallery, Post $post)
    {
        $this->post = $post;
        $this->oldCovers = $gallery::where('post_id', $post['id'])->get();
        #dd($this->oldCovers);
        if($this->post['cover'] !== null):
            $this->oldCover = $this->post['cover'];
        endif;
        $this->postCategory = $modelPost->where('parent', null)->get();
    }

    public function update()
    {
        $data = $this->validate();
        $data['post']['user_id'] = Auth::user()->id;
        #dd($data['post']);
        if($this->cover):
            $data['post']['cover'] = $this->setNameCover($data);
        else:
            $data['post']['cover'] = $this->post['cover'];
        endif;
        
        UpdatePost::dispatch(
            Post: $this->post,
            object: PostFactory::create(attributes: $data['post'])
        );
        if($this->cover):
            $this->ImageUpload();
        endif;
        if($this->covers):
            $this->UploadGallery();
        endif;
        return redirect('post');
    }

    private function setNameCover($data): string
    {
        $getExtension = $data['cover']->getClientOriginalExtension(); 
        $ImageFullName = Str::slug($data['post']['title']) .'-'. uniqid().'.'. $getExtension;
        $mountPathImage = 'images/posts';  
        $theImagePath = $mountPathImage.'/'.$ImageFullName;
        $this->coverFullName = $ImageFullName;
        return $theImagePath;
    }
   
    public function ImageUpload(): void
    {
        $image = $this->validate([
            'cover' => 'image|required'
        ]);
        $mountPathImage = 'images/posts';  
        $image['cover']->storeAs('public/'.$mountPathImage, $this->coverFullName);
    }
   
    public function UploadGallery(): void
    {
        $images = $this->validate([
            'covers' => 'nullable'
        ]);
        
        if($this->covers):
            $this->deleteOlldFiles();
            foreach($images['covers'] as $image):
                #dd($image);
                $getExtension = $image->getClientOriginalExtension(); 
                $ImageFullName = Str::slug($this->post['title']) .'-'. uniqid().'.'. $getExtension;
                $mountPathImage = 'images/posts';  
                $theImagePath = $mountPathImage.'/'.$ImageFullName;
                $this->setGallery($theImagePath);
                $image->storeAs('public/'.$mountPathImage, $ImageFullName);
            endforeach;
        endif;
    }

    private function setGallery($path): bool
    {
        $data = [
            'published' => true,
            'post_id' => $this->post['id'],
            'cover' => $path
        ];

        CreateGallery::dispatch(
            GalleryFactory::create($data)
        );

        return true;
    }

    private function deleteOlldFiles()
    {
        if($this->oldCovers):
            for ($i=0; $i < count($this->oldCovers); $i++) { 
                $cover = $this->oldCovers[$i]['cover'];
                Storage::disk('public')->delete($cover);
            }
            DB::table('galleries')->where('post_id', $this->post['id'])->delete();
        endif;
    }

    public function render()
    {
        return view('livewire.panel.post.update-controller')->layout('layouts.base');
    }
}
