<?php

namespace App\Http\Livewire\Panel\Service;

use Livewire\Component;
use Domain\Service\Models\Service;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class IndexController extends Component
{
    public $services;

    public function mount(Service $service)
    {
        $this->services = $service::with(['category'])->get();
        #dd($this->services[0]->category()->related['title']);
    }

    public function render()
    {
        return view('livewire.panel.service.index-controller')->layout('layouts.base');
    }
}
