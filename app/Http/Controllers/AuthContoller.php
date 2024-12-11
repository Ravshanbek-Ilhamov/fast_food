<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthContoller extends Controller
{
    public function logout()
    {
        $attendance = Attendance::where('user_id', auth()->user()->id)
                                ->where('worker_id', auth()->user()->worker->id)
                                ->first();
    
        if ($attendance) {
            $startTime = Carbon::createFromFormat('H:i:s', $attendance->started_time);
            $endTime = Carbon::now();

            $timer = round($startTime->diffInSeconds($endTime) / 3600, 2);

            // dd($timer);

            // $hoursWorked = $startTime->diffInMinutes($endTime);

            $attendance->update([
                'ended_time' => $endTime->format('H:i:s'),
                'time' => $timer,
            ]);

        }
        
        auth()->logout();
        return redirect('/');
    }
}
