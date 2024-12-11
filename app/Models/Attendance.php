<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'worker_id',
        'date',
        'started_time',
        'ended_time',
        'time ',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class,'worker_id');
    }
}
