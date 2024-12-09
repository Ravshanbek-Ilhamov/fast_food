<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrdersComponent extends Component
{
    public $orders;
    public function render()
    {
        $this->orders = Order::all();
        return view('admin.orders.orders-component')->layout('components.layouts.admin');
    }

    public function switchOrderStatus($id, $status){
        Order::where('id', $id)->update(['status' => $status]);
    }

    public function switchOrderItemStatus($orderId, $itemID)
    {
        $orderItem = OrderItem::where('id', $itemID)
                              ->where('order_id', $orderId)
                              ->first();
        
        if ($orderItem) {
            $orderItem->update(['status' => 'done']);
        }
    
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        
        $allItemsDone = $orderItems->every(function ($item) {
            return $item->status === 'done';
        });
        
        $firstDoneItem = $orderItems->where('status', 'done')->count() === 1;
        
        if ($allItemsDone) {
            $order = Order::where('id', $orderId)->first();
            if ($order) {
                $order->update(['status' => 'done']);
            }
        } elseif ($firstDoneItem) {
            $order = Order::where('id', $orderId)->first();
            if ($order) {
                $order->update(['status' => 'in_progress']);
            }
        }
    }
    
    
}
