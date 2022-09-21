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
    public $parent;
    public $published;

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

    public function mount($category)
    {
        $this->categoryData = Category::where('key', $category)->first();
        #dd($this->categoryData);
        $this->data = [
            'title' => $this->categoryData['title'],
            'body' => $this->categoryData->body,
            'description' => $this->categoryData->description,
            'published' => $this->categoryData->published,
            'parent' => $this->categoryData->parent,
        ]; 
        #dd($this->data);
        $this->categoryParent = new Category;
        #$this->categoryParent = $allCategory->where('parent', null)->get();
    }

    public function update()
    {
        #dd($this->data);
        $this->validate();
        $this->data['description'] = (isset($this->data['description'])) 
        ? $this->data['description'] : null;
        #dd($this->data);
        UpdateCategory::dispatch(
            Category: $this->categoryData,
            object: CategoryFactory::create(attributes: $this->data)
        );

        $this->categoryData->fresh();

        redirect('category');
    }

    public function filterChengeParentById(){
        $this->data['parent'] = (isset($this->data['parent'])) 
        ? (int) $this->data['parent'] : null;
    }

    public function filterChengeStatus(){
        $this->data['published'] = (isset($this->data['published'])) 
        ? (int) $this->data['published'] : false;
    }

    public function render()
    {
        return view('livewire.panel.category.update-controller')->layout('layouts.base');
    }
}
