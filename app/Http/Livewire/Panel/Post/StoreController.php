<?php

namespace App\Http\Livewire\Panel\Post;

use Livewire\Component;
use Domain\Post\Models\Post;
use Domain\Post\Jobs\CreatePost;
use Domain\Category\Models\Category;
use Domain\Post\Factory\PostFactory;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class StoreController extends Component
{
    use WithFileUploads;

    public $post;

    public $categories;

    public $cover;
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
        #dd($this->cover);
        $data = $this->validate();
        $getData = $this->setData($data['post']);
        dd($getData);
        CreatePost::dispatch(
            object: PostFactory::create(attributes: $getData)
        );

        return redirect('post');
    }

    public function setData(array $data): array
    {
        $data['description'] = (isset($data['description'])) 
        ? $data['description'] : null;
        $data['category_id'] = (isset($data['category_id'])) 
        ? (int) $data['category_id'] : null;
        $data['published'] = (isset($data['published'])) 
        ? (int) $data['published'] : null; 
        $data['user_id'] = Auth::user()->id;
        /* $data['cover'] = $this->cover;
        $data['covers'] = (isset($this->covers))? $this->covers : null; */
        session(['cover' => $data['cover']]);
        session(['covers' => $data['covers']]);

        return $data;
    }

    public function render()
    {
        return view('livewire.panel.post.store-controller')->layout('layouts.base');
    }
}
