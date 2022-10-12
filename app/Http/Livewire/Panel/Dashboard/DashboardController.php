<?php

namespace App\Http\Livewire\Panel\Dashboard;

use Livewire\Component;
use Domain\Post\Models\Post;
use Domain\Comment\Models\Comment;
use Domain\Service\Models\Service;
use Domain\Category\Models\Category;
use Illuminate\Support\Facades\Session;

class DashboardController extends Component
{
    public $posts;
    public $comments;
    public $categories;
    public $services;
    public $views;
    public $visitors;

    public function mount(Post $post, Comment $comment, Category $category, Service $service): void
    {
        #dd(Session::get('viewed_pages', []));
    }

    public function render()
    {
        return view('livewire.panel.dashboard.dashboard-controller')->layout('layouts.base');
    }
}
