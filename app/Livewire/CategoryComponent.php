<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $order;


    public $editingOrder;
    public $editingName;
    public $editingId;

    public function render()
    {
        $categories = Category::paginate(15);
        return view('category.category-component',compact('categories'))->layout('components.layouts.admin');
    }



    public function store(){
        $validated = $this->validate();
        Category::create($validated);
        $this->reset();
        session()->flash('success','Category Created Successfully');
    }

    public function delete(Category $category){
        $category->delete();
    }

    public function findEditing($id)
    {
        $category = Category::findOrFail($id);
    
        $this->editingId = $category->id;
        $this->editingName = $category->name;
        $this->editingOrder = $category->order;
    }

    public function updateCategory(){
        $this->validate([
            'editingName' => 'required|string|max:255',
            'editingOrder' => 'required|integer',
        ]);

        $category = Category::findOrFail($this->editingId);
        $category->name = $this->editingName;
        $category->order = $this->editingOrder;
        $category->save();

        session()->flash('success', 'Category updated successfully.');
        $this->reset('editingName', 'editingOrder', 'editingId');   
    }
}
    