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

    public $editingName;
    public $editingId;

    public function render()
    {
        $categories = Category::orderBy('order')->paginate(15);
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
    }

    public function updateCategory(){
        $this->validate([
            'editingName' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($this->editingId);
        $category->name = $this->editingName;
        $category->save();

        $this->reset();
        session()->flash('success', 'Category updated successfully.');
    }

    public function updateOrder($categories){
        foreach ($categories as $category) {
            Category::where('id', $category['value'])->update(['order' => $category['order']]);
        }
    }   


}
    