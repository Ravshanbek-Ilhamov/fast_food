<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaiterOrder extends Model
{
    protected $fillable = [
        'order_id',
        'worker_id',
    ];
}
