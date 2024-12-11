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
    
            if (!$worker) {
                session()->flash('error', 'Worker information is missing for this user.');
                return redirect('/');
            }
    
            $attendance = Attendance::create([
                'user_id' => Auth::user()->id,
                'worker_id' => $worker->id,
                'date' => Carbon::now()->format('Y-m-d'),
                'started_time' => Carbon::now()->format('H:i:s'),
            ]);
    
            Log::info('Attendance created', ['attendance' => $attendance]);
    
            return redirect('/user-page');
        } else {
            session()->flash('error', 'Email or password is incorrect.');
            return redirect('/');
        }
    }
    
    
    
}
