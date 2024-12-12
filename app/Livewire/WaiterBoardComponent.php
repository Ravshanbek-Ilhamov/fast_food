<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\WaiterOrder;
use Livewire\Component;

class WaiterBoardComponent extends Component
{
    public $orders;
    public function render()
    {

        $this->orders = Order::all();
        return view('admin.waiterboard.waiter-board-component')->layout('components.layouts.admin');
    }

    public function switchOrderStatus($id, $status){
        Order::where('id', $id)->update(['status' => $status]);
        WaiterOrder::create([
            'order_id' => $id,
            'worker_id' => auth()->user()->worker->id
        ]);
    }
}
