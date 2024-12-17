<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'worker_id',
        'date',
        'salary_amount',
        'paid_amount',
        'unpaid_amount',
        'type',
   ];

   public function worker()
   {
       return $this->belongsTo(Worker::class);
   }
}
