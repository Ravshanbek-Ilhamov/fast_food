<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class AllOrderComponent extends Component
{
    public $orders;
    public function render()
    {

        $this->orders = Order::where('date', date('Y-m-d'))->get();
        return view('user.allOrders.all-order-component');
    }
}
