<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
class AttendanceComponent extends Component
{
    use WithPagination;

    public $user_id, $worker_id, $date, $started_time, $ended_time, $time, $attendance_id;
    public $createForm = false;
    public $editForm = false;

    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'worker_id' => 'required|exists:workers,id',
        'date' => 'required|date',
        'started_time' => 'required|date_format:H:i:s',
        'ended_time' => 'required|date_format:H:i:s',
    ];

    public function render()
    {
        return view('admin.attendance.attendance-component', [
            'attendances' => Attendance::paginate(10),
        ])->layout('components.layouts.admin');
    }

    public function formCreate()
    {
        $this->resetForm();
        $this->createForm = true;
    }

    public function store()
    {
        $this->validate();
        Attendance::create([
            'user_id' => $this->user_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'time' => $this->time,
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
        $this->validate();
        $attendance = Attendance::findOrFail($this->attendance_id);
        $attendance->update([
            'user_id' => $this->user_id,
            'worker_id' => $this->worker_id,
            'date' => $this->date,
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'time' => $this->time,
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

