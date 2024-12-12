<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
class AttendanceComponent extends Component
{
    use WithPagination;

    public $user_id, $worker_id,$workers, $days, $date, $started_time, $ended_time, $time, $attendance_id, $fullDate, $monthName, $year, $daysInMonth;
    public $createForm = false;
    public $editForm = false;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'worker_id' => 'required|exists:workers,id',
        'date' => 'required|date',
        'started_time' => 'required|date_format:H:i:s',
        'ended_time' => 'required|date_format:H:i:s',
    ];

    public function mount()
    {
        $now = Carbon::now('Asia/Tashkent'); 
        
        $this->fullDate = $now; // The full Carbon instance
        $this->date = $now->toDateString(); // "2024-12-03" as a string in the 'Y-m-d' format
        $this->monthName = $now->format('F'); // "December" (current month name)
        $this->year = $now->year; 
        $this->daysInMonth = $now->daysInMonth; 
    }
    public function render()
    {
        $this->days = [];
        $this->workers = Worker::all();
        $parsedDate = Carbon::parse($this->date); 
        
        for ($i = 1; $i <= $this->daysInMonth; $i++) { // Use <= to include the last day
            $this->days[] = Carbon::create($parsedDate->year, $parsedDate->month, $i);
        }   

        return view('admin.attendance.attendance-component', [
            'attendances' => Attendance::paginate(10),
        ])->layout('components.layouts.admin');
    }

    public function updateAttendance($workerId, $date)
    {
        $attendance = Attendance::where('worker_id', $workerId)->where('date', $date)->first();
        if ($attendance) {
            $this->editForm = true;
            $this->attendance_id = $attendance->id;
            $this->user_id = $attendance->user_id;
            $this->worker_id = $attendance->worker_id;
            $this->date = $attendance->date;
            $this->started_time = $attendance->started_time;
            $this->ended_time = $attendance->ended_time;
            $this->time = $attendance->time;
        }
    }


    public function findTheDate()
    {
        if ($this->date) {
            $parsedDate = Carbon::parse($this->date); 
            $this->monthName = $parsedDate->format('F');
            $this->year = $parsedDate->year;
            $this->daysInMonth = $parsedDate->daysInMonth; 
        }
    }

    public function formCreate()
    {
        $this->resetForm();
        $this->createForm = true;
    }

    public function store()
    {
        $startTime = Carbon::createFromFormat('H:i:s', $this->started_time);
        // $endTime = Carbon::now();

        $timer = round($startTime->diffInSeconds($this->endTime) / 3600, 2);

        $this->validate();
        Attendance::create([
            'user_id' => $this->user_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'time' => $timer,
        ]);
        session()->flash('message', 'Attendance record created successfully!');
        $this->resetForm();
        $this->createForm = false;
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $this->attendance_id = $attendance->id;
        $this->user_id = $attendance->user_id;
        $this->worker_id = $attendance->worker_id;
        $this->date = $attendance->date;
        $this->started_time = $attendance->started_time;
        $this->ended_time = $attendance->ended_time;
        $this->time = $attendance->time;
        $this->editForm = true;
        $this->createForm = false;
    }

    public function update()
    {
        $attendance = Attendance::findOrFail($this->attendance_id);
    
        $startTime = Carbon::createFromFormat('H:i:s', $attendance->started_time);
        $endTime = Carbon::createFromFormat('H:i:s', $this->ended_time);
    
        // Calculate the total hours worked
        $timer = round($startTime->diffInSeconds($endTime) / 3600, 2);
    
        $this->validate();
    
        $attendance->update([
            'user_id' => $this->user_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'time' => $timer,
        ]);
    
        session()->flash('message', 'Attendance record updated successfully!');
        $this->resetForm();
        $this->editForm = false;
    }
    

    public function delete($id)
    {
        Attendance::destroy($id);
        session()->flash('message', 'Attendance record deleted successfully!');
    }

    public function cancel()
    {
        $this->resetForm();
        $this->createForm = false;
        $this->editForm = false;
    }

    private function resetForm()
    {
        $this->user_id = '';
        $this->worker_id = '';
        $this->date = '';
        $this->started_time = '';
        $this->ended_time = '';
        $this->time = '';
        $this->attendance_id = null;
    }
}

