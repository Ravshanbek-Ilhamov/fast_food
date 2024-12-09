<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class CartComponent extends Component
{

    public $superTotal = 0;

    public function render()
    {
        $foods = session('foods', []);
        $this->superTotal = array_sum(array_column($foods, 'total_price')); 

        return view('user.cart.cart-component')->layout('components.layouts.app');
    }


    public function updateQuantity($foodId, $quantity)
    {
        $foods = session('foods', []);
    
        foreach ($foods as &$food) {
            if ($food['id'] == $foodId) {
                $food['quantity'] = max(1, $quantity);
                $food['total_price'] = $food['price'] * $food['quantity'];
                break;
            }
        }
    
        session(['foods' => $foods]);
    }

    public function removeFromCart($foodId)
    {
        $foods = session('foods', []);
    
        foreach ($foods as $index => $food) {
            if ($food['id'] == $foodId) {
                unset($foods[$index]);
                break;
            }
        }
    
        session(['foods' => $foods]);
    }

    public function saveOrder(){
        $foods = session('foods', []);   
        $queue = Order::where('date', date('Y-m-d'))->count();
        $order = Order::create([
            'date' => date('Y-m-d'),
            'queue' => $queue + 1,
            'total_price' => $this->superTotal,
        ]);

        foreach ($foods as $food) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $food['id'],
                'quantity' => $food['quantity'],
                'total_price' => $food['total_price'],
            ]);
        }

        session()->forget('foods');
        return redirect('/user-page');
    }

    public function updateCartQuantity($foodId, $increment = true)
    {
        $foods = session('foods', []);
    
        foreach ($foods as &$food) {
            if ($food['id'] == $foodId) {
                $food['quantity'] = $increment ? $food['quantity'] + 1 : max(1, $food['quantity'] - 1);
                $food['total_price'] = $food['price'] * $food['quantity'];
                break;
            }
        }
    
        session(['foods' => $foods]); // Save updated foods back to session
    }
    
    public function decrementQuantity($foodId)
    {
        $this->updateCartQuantity($foodId, false);
    }
    
    public function incrementQuantity($foodId)
    {
        $this->updateCartQuantity($foodId, true);
    }
    
    
    
}
