<?php

namespace App\Http\Livewire\Panel\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Domain\Post\Models\Post;
use Livewire\WithFileUploads;
use Domain\Post\Jobs\CreatePost;
use Domain\Category\Models\Category;
use Domain\Post\Factory\PostFactory;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $post;

    public $categories;

    public $cover;
    private $coverFullName;
    public $covers = [];
    
    protected $rules = [
        'post.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:posts,title'
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
            'required',
            'image',
            'mimes:jpg,png',
        ],
        'covers' => [
            'nullable',
            'array',
        ],
    ];

    public function mount(Category $modelPost, Post $posts)
    {
        $this->post = $posts;
        #dd($this->post[5]);
        $this->postCategory = $modelPost->where('parent', null)->get();
    }

    public function submit()
    {
        $data = $this->validate();
        $data['post']['user_id'] = Auth::user()->id;
        $data['post']['cover'] = $this->setNameCover($data);
        
        CreatePost::dispatch(
            object: PostFactory::create(attributes: $data['post'])
        );
        $this->ImageUpload();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
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

    public function render()
    {
        return view('livewire.panel.post.store-controller')->layout('layouts.base');
    }
}
