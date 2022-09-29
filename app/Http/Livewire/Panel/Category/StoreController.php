<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Domain\Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Domain\Category\Jobs\CreateCategory;
use Domain\Category\Factory\CategoryFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StoreController extends Component
{
    use LivewireAlert;

    public $category = [
        'title',
        'slug',
        'body',
        'description',
        'published',
        'parent',
    ];
    public $categoryParent;
    
    protected $rules = [
        'category.title' => [
            'required',
            'string',
            'min:3',
            'max:255',
            'unique:categories,title'
        ],
        'category.body' => [
            'required',
            'string',
            'min:3',
        ],
        'category.description' => [
            'nullable',
            'string',
            'max:120',
        ],
        'category.parent' => [
            'nullable',
            'integer',
        ],
        'category.published' => [
            'nullable',
            'boolean',
        ],
    ];

    public function mount(Category $modelCategory)
    {
        $this->categoryParent = $modelCategory->where('parent', null)->get();
    }

    public function submit()
    {
        $data = $this->validate();
        $data['category']['description'] = (isset($data['category']['description'])) 
        ? $data['category']['description'] : null;
        $data['category']['parent'] = (isset($data['category']['parent'])) 
        ? (int) $data['category']['parent'] : null;
        $data['category']['published'] = (isset($data['category']['published'])) 
        ? (int) $data['category']['published'] : null;
        dd($data['category']);
        CreateCategory::dispatch(
            object: CategoryFactory::create(attributes: $data['category'])
        );
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        return redirect('category');
    }

    public function render()
    {
        return view('livewire.panel.category.store-controller')->layout('layouts.base');
    }
}
