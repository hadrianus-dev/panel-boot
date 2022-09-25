<?php

namespace App\Http\Livewire\Panel\Portfolio;

use Livewire\Component;
use Domain\Portfolio\Models\Portfolio;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class IndexController extends Component
{
    public $portfolio = [];

    public function mount()
    {
        $portfolios = QueryBuilder::for(
            subject: Portfolio::class,
        )->allowedIncludes(
            includes: ['services']
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();
        
        $this->portfolio = $portfolios;
        #dd($this->portfolio);
    }

    public function render()
    {
        return view('livewire.panel.portfolio.index-controller')->layout('layouts.base');
    }
}
