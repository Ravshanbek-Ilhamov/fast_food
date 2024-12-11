<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Worker;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;

class WorkersComponent extends Component
{
    
    use WithPagination;

    public $editing, $createForm = false, $editForm = false;
    public $sections, $section_id,$user_id, $monthly_salary_type,$users, $monthly_salary_amount, $bonus, $hours_per_month, $started_time, $ended_time;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $workers = Worker::with('section')->paginate(10);
        $this->sections = Section::all();
        $this->users = User::all();

        return view('admin.workers.workers-component', ['workers' => $workers])
            ->layout('components.layouts.admin');
    }

    public function findEditing($id)
    {
        $this->editing = Worker::findOrFail($id);
    }

    public function delete($id)
    {
        Worker::findOrFail($id)->delete();

        session()->flash('success', 'Worker deleted successfully!');
    }

    public function formCreate()
    {
        $this->resetForm();
        $this->createForm = true;
    }

    public function cancel()
    {
        $this->resetForm();
        $this->createForm = false;
        $this->editForm = false;
    }

    public function store()
    {
        // Validate input
        $this->validate([
            'section_id' => 'required|exists:sections,id',
            'user_id' => 'required|exists:users,id',
            'monthly_salary_type' => 'required|string',
            'monthly_salary_amount' => 'required|numeric',
            'bonus' => 'required|numeric',
            'started_time' => 'required',
            'ended_time' => 'required',
        ]);
        
        $started = Carbon::createFromFormat('H:i', $this->started_time);
        $ended = Carbon::createFromFormat('H:i', $this->ended_time);
    
        $totalHours = $started->diffInHours($ended);
    
    
        // Save worker data
        Worker::create([
            'user_id' => $this->user_id, // You can adjust this as needed
            'section_id' => $this->section_id,
            'monthly_salary_type' => $this->monthly_salary_type,
            'monthly_salary_amount' => $this->monthly_salary_amount,
            'bonus' => $this->bonus,
            'hours_per_month' => $totalHours * 30, // Approximate monthly hours
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'total_hours' => $totalHours,
        ]);

        session()->flash('success', 'Worker created successfully!');
        $this->cancel();
    }
    

    public function edit(Worker $worker)
    {
        $this->editing = $worker;
        $this->section_id = $worker->section_id;
        $this->monthly_salary_type = $worker->monthly_salary_type;
        $this->monthly_salary_amount = $worker->monthly_salary_amount;
        $this->bonus = $worker->bonus;
        $this->hours_per_month = $worker->hours_per_month;
        $this->started_time = $worker->started_time;
        $this->ended_time = $worker->ended_time;

        $this->createForm = false;
        $this->editForm = true;
    }

    public function update()
    {
        // Validate input
        $this->validate([
            'section_id' => 'required|exists:sections,id',
            'user_id' => 'required|exists:users,id',
            'monthly_salary_type' => 'required|string',
            'monthly_salary_amount' => 'required|numeric',
            'bonus' => 'required|numeric',
            'hours_per_month' => 'nullable|numeric',
            'started_time' => 'required|string', 
            'ended_time' => 'nullable|string', 
        ]);
    
        $started = Carbon::createFromFormat('H:i:s', trim($this->started_time));
        $ended = $this->ended_time ? Carbon::createFromFormat('H:i:s', trim($this->ended_time)) : null;
    
        $totalHours = $ended ? $started->diffInHours($ended) : 0;
    
        if ($ended && $ended->lessThan($started)) {
            $ended->addDay();
            $totalHours = $started->diffInHours($ended);
        }
    
        $this->editing->update([
            'section_id' => $this->section_id,
            'user_id' => $this->editing->user_id,
            'monthly_salary_type' => $this->monthly_salary_type,
            'monthly_salary_amount' => $this->monthly_salary_amount,
            'bonus' => $this->bonus,
            'total_hours' => $totalHours,
            'hours_per_month' => $totalHours * 30, 
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
        ]);
    
        session()->flash('success', 'Worker updated successfully!');
        $this->cancel();
    }
    

    private function resetForm()
    {
        $this->reset(['section_id', 'monthly_salary_type', 'monthly_salary_amount', 'bonus', 'hours_per_month', 'started_time', 'ended_time', 'editing']);
    }

    
}
