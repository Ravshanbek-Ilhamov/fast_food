<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'food_id',
        'quantity',
        'total_price',
        'status',
    ];

    public function order() {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function food() {
        return $this->belongsTo(Food::class,'food_id');
    }
}
