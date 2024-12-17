<?php

namespace App\Livewire;

use App\Models\Salary;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class KPISalaryComponent extends Component
{

    use WithPagination;


    public $createForm = false, $worker_id, $salary_amount, $paid_amount, $unpaid_amount,$type, $editForm = false, $fullDate, $date, $monthName, $year, $daysInMonth;

    public function mount()
    {
        $now = Carbon::now('Asia/Tashkent'); 
        $this->fullDate = $now;
        $this->date = $now->toDateString(); 
        $this->monthName = $now->format('F');
        $this->year = $now->year; 
        $this->daysInMonth = $now->daysInMonth; 
    }
    public function render()
    {
        $workers = Worker::where('monthly_salary_type', 'kpi')->paginate(10);
        return view('admin.salary.k-p-i-salary-component',compact('workers'))->layout('components.layouts.admin');
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

    public function store(){

        $this->validate([
            'worker_id' => 'required',
            'paid_amount' => 'required',
            'date' => 'required',
        ]);

       $worker = Worker::find($this->worker_id);

        Salary::create([
            'worker_id' => $this->worker_id,
            'salary_amount' => $worker->monthly_salary_amount,
            'paid_amount' => ($this->paid_amount / 100) * $worker->bonus,
            'unpaid_amount' => $worker->monthly_salary_amount - ($this->paid_amount / 100) * $worker->bonus,
            'date' => $this->date,
            'type' => $worker->monthly_salary_type,
        ]);
        $this->reset();
        $this->createForm = false;
        $this->editForm = false;
    }

    public function formCreate(){
        $this->createForm = true;
        $this->reset(['worker_id','salary_amount','paid_amount','unpaid_amount','date','type']);
    }

    public function cancel(){
        $this->reset();
        $this->createForm = false;
        $this->editForm = false;
    }
}
