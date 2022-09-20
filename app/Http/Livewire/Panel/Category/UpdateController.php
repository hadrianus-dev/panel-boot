<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Domain\Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Domain\Category\Jobs\UpdateCategory;
use Domain\Category\Factory\CategoryFactory;

class UpdateController extends Component
{
    public $categoryData;
    public $categoryParent;

    public $data = [
        'title',
        'body',
        'description',
        'published',
        'parent',
    ];
    
    protected $rules = [
        'data.title' => [
            'required',
            'string',
            'min:3',
            'max:255'
        ],
        'data.body' => [
            'required',
            'string',
            'min:3',
        ],
        'data.description' => [
            'nullable',
            'string',
            'max:120',
        ],
        'data.parent' => [
            'nullable',
            'integer',
        ],
        'data.published' => [
            'nullable',
            'boolean',
        ],
    ];

    protected $listeners = ['catEdit'];

    public function catEdit($id){
        dd($id);
    }

    public function mount($category)
    {
        $this->categoryData = Category::where('key', $category)->first();
        #dd($this->categoryData);
        $this->data = [
            'title' => $this->categoryData['title'],
            'body' => $this->categoryData->body,
            'description' => $this->categoryData->description,
        ]; 
        #dd($this->data);
        $allCategory = new Category;
        $this->categoryParent = $allCategory->where('parent', null)->get();
    }

    public function update()
    {
        $this->validate();
        #dd($this->data);
        $this->data['description'] = (isset($this->data['description'])) 
        ? $this->data['description'] : null;
        $this->data['parent'] = (isset($this->data['parent'])) 
        ? (int) $this->data['parent'] : null;
        $this->data['published'] = (isset($this->data['published'])) 
        ? (int) $this->data['published'] : false;
       # dd($this->data);
        UpdateCategory::dispatch(
            Category: $this->categoryData,
            object: CategoryFactory::create(attributes: $this->data)
        );

        $this->categoryData->fresh();

        redirect('category');
    }


    public function render()
    {
        return view('livewire.panel.category.update-controller')->layout('layouts.base');
    }
}
