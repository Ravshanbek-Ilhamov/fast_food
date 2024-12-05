<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FoodComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $categories;
    public $food_id;
    public $name;
    public $price;
    public $image_path;
    public $saved_image;
    public $category_id;    

    public $editingname;
    public $editingprice;
    public $editingimage;
    public $editingcategory_id;  

    public $editmodal = false;
    public $createmodal = false;

    public function render()
    {
        $this->categories = Category::all();
        $foods = Food::paginate(10);
        return view('food.food-component',compact('foods'))->layout('components.layouts.admin');
    }


    public function store(){

        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'image_path' => 'image|max:2048',
            'category_id' => 'required',
        ]);

        // $validated = $this->validate();

        $filePath = $this->image_path->store('food', 'public');
        $this->saved_image = $filePath;
        // dd($this->saved_image);
        Food::create([
            'name' => $this->name,  
            'price' => $this->price,
            'image_path' => $filePath,
            'category_id' => $this->category_id 
        ]);

        $this->reset();
        session()->flash('success','Food Created Successfully');
    }

    public function delete(Food $food){
        $food->delete();
    }

    public function findEditing(Food $food){
        $this->food_id = $food->id;
        $this->editingname = $food->name;
        $this->editingprice = $food->price;
        $this->editingimage = $food->image_path;
        $this->editingcategory_id = $food->category_id;

    }

    public function updatefood(){

        // dd($this->editingimage);
        $this->validate([
            'editingname' => 'required|string|max:255',
            'editingprice' => 'required',
            'editingimage' => 'image|max:2048',
            'editingcategory_id' => 'required',
        ]);

        $food = Food::find($this->food_id);

        if($this->editingimage){
            $filePath = $this->editingimage->store('food', 'public');
            $this->saved_image = $filePath;
        }


        $food->update([
            'name' => $this->editingname,
            'price' => $this->editingprice, 
            'category_id' => $this->editingcategory_id,
            'image_path' => $filePath ?? '',
        ]);

        $this->reset();
        session()->flash('success','Food Updated Successfully');
    }   
}
