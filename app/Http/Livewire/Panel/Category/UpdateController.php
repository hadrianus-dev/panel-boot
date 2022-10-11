<?php

namespace App\Http\Livewire\Panel\Category;

use Livewire\Component;
use Domain\Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Domain\Category\Jobs\UpdateCategory;
use Domain\Category\Factory\CategoryFactory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateController extends Component
{
    use LivewireAlert;
    
    public $Category;
    public $categoryParent;
    public $parent;
    public $published;
    
    protected $rules = [
        'Category.title' => [
            'required',
            'string',
            'min:3',
            'max:255'
        ],
        'Category.body' => [
            'required',
            'string',
            'min:3',
        ],
        'Category.description' => [
            'nullable',
            'string',
            'min:3',
        ],
        'Category.parent' => [
            'nullable',
            'integer',
        ],
        'Category.published' => [
            'nullable',
            'boolean',
        ],
    ];

    public function mount(Category $category)
    {
        $this->Category = $category;
        #dd($this->Category);
       
        #dd($this->Category);
        $this->categoryParent = new Category;
        #$this->categoryParent = $allCategory->where('parent', null)->get();
    }

    public function update()
    {
        #dd($this->Category);
        $data = $this->validate();
        $this->Category['description'] = (isset($this->Category['description'])) 
        ? $this->Category['description'] : null;
        #dd($data['Category']);
        UpdateCategory::dispatch(
            Category: $this->Category,
            object: CategoryFactory::create(attributes: (array) $data['Category'])
        );

        #$this->Category->fresh();
        $this->alert('success', 'Sucesso', [
            'text' => 'Operação completamente bem sucedida!',
            'position' => 'center',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
        redirect('category');
    }

    public function filterChengeParentById(){
        $this->Category['parent'] = (isset($this->Category['parent'])) 
        ? (int) $this->Category['parent'] : null;
    }

    public function filterChengeStatus(){
        $this->Category['published'] = (isset($this->Category['published'])) 
        ? (int) $this->Category['published'] : false;
    }

    public function render()
    {
        return view('livewire.panel.category.update-controller')->layout('layouts.base');
    }
}
