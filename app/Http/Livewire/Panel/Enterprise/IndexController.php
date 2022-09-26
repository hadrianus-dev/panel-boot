<?php

namespace App\Http\Livewire\Panel\Enterprise;

use Livewire\Component;
use Domain\Service\Models\Service;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Domain\Enterprise\Models\Enterprise;

class IndexController extends Component
{
    public $enterprise = [];
    public $services;

    public function mount()
    {
        $enterprise = QueryBuilder::for(
            subject: Enterprise::class,
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->first();

        $this->services = Service::where('published', true)->get();
        
        $this->enterprise = $enterprise;
        #dd($this->enterprise);
    }

    public function render()
    {
        return view('livewire.panel.enterprise.index-controller')->layout('layouts.base');
    }
}