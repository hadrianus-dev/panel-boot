<?php

namespace App\Http\Livewire\Panel\Dashboard;

use Domain\Category\Models\Category;
use Domain\Comment\Models\Comment;
use Domain\Post\Models\Post;
use Domain\Service\Models\Service;
use Livewire\Component;

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
        # code...
    }

    public function render()
    {
        return view('livewire.panel.dashboard.dashboard-controller')->layout('layouts.base');
    }
}
