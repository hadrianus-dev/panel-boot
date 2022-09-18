<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Domain\Category\Models\Category;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\V1\Category\CategoryResource;

class IndexController extends Component
{
    public $category;

    public function mount()
    {
        $Categories = QueryBuilder::for(
            subject: Category::class,
        )->allowedIncludes(
            includes: ['user']
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();

        
        $this->category = $Categories;
        #dd($this->category);
           
    }

    public function render()
    {
        return view('livewire.panel.category.index-controller')->layout('layouts.base');
    }
}
