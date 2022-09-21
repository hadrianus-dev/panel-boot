<?php

namespace App\Http\Livewire\Panel\Service;

use Livewire\Component;
use Domain\Service\Models\Service;
use Domain\Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Domain\Service\Jobs\CreateService;
use Domain\Service\Factory\ServiceFactory;

class StoreController extends Component
{

    public $service = [
        'title',
        'body',
        'description',
        'published',
        'category_id'
    ];
    public $serviceParent;
    
    protected $rules = [
        'service.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:categories,title'
        ],
        'service.body' => [
            'required',
            'string',
            'min:3',
        ],
        'service.description' => [
            'nullable',
            'string',
            'max:120',
        ],
        'service.category_id' => [
            'nullable',
            'integer',
        ],
        'service.published' => [
            'nullable',
            'boolean',
        ],
    ];

    public function mount(Category $modelService)
    {
        $this->category = $modelService->where('parent', null)->get();
    }

    public function submit()
    {
        $data = $this->validate();
        $data['service']['description'] = (isset($data['service']['description'])) 
        ? $data['service']['description'] : null;
        $data['service']['category_id'] = (isset($data['service']['category_id'])) 
        ? (int) $data['service']['category_id'] : null;
        $data['service']['published'] = (isset($data['service']['published'])) 
        ? (int) $data['service']['published'] : null;
        #dd($data['service']);
        CreateService::dispatch(
            object: ServiceFactory::create(attributes: $data['service'])
        );

        return redirect('service');
    }

    public function render()
    {
        return view('livewire.panel.service.store-controller')->layout('layouts.base');
    }
}
