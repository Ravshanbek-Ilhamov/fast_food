<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Worker;
use App\Models\Section;
use Carbon\Carbon;

class WorkersComponent extends Component
{
    
    use WithPagination;

    public $editing, $createForm = false, $editForm = false;
    public $sections, $section_id, $monthly_salary_type, $monthly_salary_amount, $bonus, $hours_per_month, $started_time, $ended_time;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $workers = Worker::with('section')->paginate(10);
        $this->sections = Section::all();

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
        $this->validate([
            'section_id' => 'required|exists:sections,id',
            'monthly_salary_type' => 'required|string',
            'monthly_salary_amount' => 'required|numeric',
            'bonus' => 'required|numeric',
            'hours_per_month' => 'required|numeric',
            'started_time' => 'required',
            'ended_time' => 'nullable',
        ]);

        Worker::create([
            'user_id' => 1,
            'section_id' => $this->section_id,
            'monthly_salary_type' => $this->monthly_salary_type,
            'monthly_salary_amount' => $this->monthly_salary_amount,
            'bonus' => $this->bonus,
            'hours_per_month' => $this->hours_per_month,
            'started_time' => $this->started_time,
            'ended_time' => $this->ended_time,
            'total_hours' => Carbon::parse($this->started_time)->diffInHours(Carbon::parse($this->ended_time)),
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
        $this->validate([
            'section_id' => 'required|exists:sections,id',
            'monthly_salary_type' => 'required|string',
            'monthly_salary_amount' => 'required|numeric',
            'bonus' => 'required|numeric',
            'hours_per_month' => 'required|numeric',
            'started_time' => 'required',
            'ended_time' => 'nullable|',
        ]);

        $this->editing->update([
            'section_id' => $this->section_id,
            'monthly_salary_type' => $this->monthly_salary_type,
            'monthly_salary_amount' => $this->monthly_salary_amount,
            'bonus' => $this->bonus,
            'hours_per_month' => $this->hours_per_month,
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
