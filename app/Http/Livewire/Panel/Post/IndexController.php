<?php

namespace App\Http\Livewire\Panel\Post;

use Livewire\Component;
use Domain\Post\Models\Post;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class IndexController extends Component
{
    public $post = [];

    public function mount()
    {
        $posts = QueryBuilder::for(
            subject: Post::class,
        )->allowedIncludes(
            includes: ['services']
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();
        
        $this->post = $posts;
        #dd($this->post);
    }

    public function render()
    {
        return view('livewire.panel.post.index-controller')->layout('layouts.base');
    }
}
