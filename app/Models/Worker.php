<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'user_id',
        'section_id',
        'monthly_salary_type',
        'monthly_salary_amount',
        'bonus',
        'hours_per_month',
        'started_time',
        'ended_time',
        'total_hours',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

}
