<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthContoller extends Controller
{
    public function logout()
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)
                                ->where('worker_id', auth()->user()->worker->id)
                                ->latest('id') 
                                ->first();
    
        if ($attendance) {
            $startTime = Carbon::createFromFormat('H:i:s', $attendance->started_time);
            $endTime = Carbon::now();
    
            $hoursWorked = $startTime->diffInMinutes($endTime);
            $attendance->update([
                'ended_time' => $endTime->format('H:i:s'),
                'time' => $hoursWorked,
            ]);
        }
        auth()->logout();
        return redirect('/');
    }
}
