<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class UserPageComponent extends Component
{

    use WithPagination;

    public $categories;
    public $filtercategory_id;
    public $foods;
    public $foodCount;

    public function render()
    {

        if($this->filtercategory_id != null){
            $this->foods = Food::where('category_id', $this->filtercategory_id)->get();
        }else{
            $this->foods = Food::all();   
        }

        $foods = session('foods', []);
        $this->foodCount = count($foods); 

        $this->categories = Category::all();
        return view('user.userPage.user-page-component');
    }

    public function filterCategory($category_id){
        $this->filtercategory_id = $category_id;
    }

    public function addToCart($foodId)
    {
        $cartingFood = Food::find($foodId);
    
        $foods = session('foods', []);
    
        $exists = false;
        foreach ($foods as &$food) {
            if ($food['id'] == $cartingFood->id) {
                $exists = true;
                $food['quantity'] += 1; 
                break;
            }
        }
        if (!$exists) {
            $foods[] = [
                'id' => $cartingFood->id,
                'name' => $cartingFood->name,
                'price' => $cartingFood->price,
                'image' => $cartingFood->image_path,
                'quantity' => 1, 
                'total_price' => $cartingFood->price, 
            ];
        }
        session(['foods' => $foods]);
    }
    


}
