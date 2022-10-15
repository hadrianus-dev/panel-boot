<?php

namespace App\Http\Livewire\Panel\Dashboard;

use Livewire\Component;
use Domain\Post\Models\Post;
use Illuminate\Http\Request;
use Domain\Comment\Models\Comment;
use Domain\Service\Models\Service;
use Shetabit\Visitor\Models\Visit;
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

    public function mount(Visit $visit, Post $post, Comment $comment, Category $category, Service $service, Request $request): void
    {
        #dd(Session::get('viewed_pages', []));
        #dd($post->visitLogs()->visitor()->count());
        $this->visitors = $visit;
        $this->posts = $post;
        $this->comments = $comment;
        $this->services = $service;
        $this->categories = $category;
        #$num->number_format()
        /* AIzaSyDYc0GI2i9J8wPyc07XQmB3XbWp2KEMfmU */ /* 337416032 */
    }

    public function render()
    {
        return view('livewire.panel.dashboard.dashboard-controller')->layout('layouts.base');
    }
}
