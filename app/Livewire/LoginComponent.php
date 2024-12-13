<?php

namespace App\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LoginComponent extends Component
{
    public $password, $email;
    public function render()
    {   
        return view('auth.login-component')->layout('components.layouts.empty');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $worker = Auth::user()->worker;
            
            $attend = Attendance::where('user_id', Auth::user()->id)->where('date', Carbon::now()->format('Y-m-d'))->first();

            if (!$worker) {
                session()->flash('error', 'Worker information is missing for this user.');
                return redirect('/login');
            }

            if ($attend) {
                session()->flash('error', 'You have already logged in.');
                return redirect('/categories');
            }
    
            $attendance = Attendance::create([
                'user_id' => Auth::user()->id,
                'worker_id' => $worker->id,
                'date' => Carbon::now()->format('Y-m-d'),
                'started_time' => Carbon::now()->format('H:i:s'),
                'ended_time' => null,
                'time' => 0
            ]);
            Log::info('Attendance created', ['attendance' => $attendance]);
            return redirect('/categories');
        } else {
            session()->flash('error', 'Email or password is incorrect.');
            return redirect('/login');
        }
    }
    
    
    
}
