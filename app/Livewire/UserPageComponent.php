<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Livewire\WithPagination;

class UserPageComponent extends Component
{

    // use WithPagination;

    public $categories;
    public $filtercategory_id;
    public $foods;

    public function render()
    {
        if($this->filtercategory_id != null){
            $this->foods = Food::where('category_id', $this->filtercategory_id)->get();
        }else{
            $this->foods = Food::all();   
        }

        $this->categories = Category::all();
        return view('userPage.user-page-component');
    }

    public function filterCategory($category_id){
        $this->filtercategory_id = $category_id;
    }

}
