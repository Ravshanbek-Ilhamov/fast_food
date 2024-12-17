<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaiterOrder extends Model
{
    protected $fillable = [
        'order_id',
        'worker_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }


    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }
}
