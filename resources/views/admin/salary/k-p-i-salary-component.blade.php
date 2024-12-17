<div>
    <div class="content-wrapper">
        <section id="menu" class="content py-4">

            @if ($createForm || $editForm)
            <div class="mb-3">
                <label for="role" class="form-label">Worker:</label>
                <select wire:model="worker_id" class="form-control" id="role">
                    <option value="">Select Worker</option>
                    @foreach ($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->user->name }}</option>
                    @endforeach
                </select>
                @error('worker_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            

                <!-- Date -->
                <div class="mb-3">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" wire:model.defer="date"
                        class="form-control @error('date') is-invalid @enderror" id="date">    
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Paid Amount -->
                <div class="mb-3">
                    <label for="paid_amount" class="form-label">Paid Amount:</label>
                    <input type="number" min="0" 
                        {{-- max="{{ $monthly_salary_amount }}"  --}}
                        wire:model.defer="paid_amount" 
                        class="form-control @error('paid_amount') is-invalid @enderror" id="paid_amount">
                    @error('paid_amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- <p class="text-muted">Maximum payable amount: {{ $monthly_salary_amount }}</p> --}}


                @if ($editForm)
                    <button class="btn btn-primary" wire:click="update">Update</button>
                @else
                    <button class="btn btn-primary" wire:click="store">Store</button>
                @endif
                <button class="btn btn-primary" wire:click="cancel">Cancel</button>
            @else

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Salary</h2>
                <button type="button" class="btn btn-primary mr-3" wire:click="formCreate">Create</button>
            </div>

            <input 
                class="form-control m-3" 
                type="date" 
                wire:change="findTheDate" 
                wire:model="date" 
                style="width: 200px; font-size: 14px;"
                data-bs-toggle="tooltip" 
                title="Select a date to filter">
                
            <h4 class="mr-3 m-3" style="color: rgb(10, 16, 20)">
                {{$monthName}} {{$year}}
            </h4>
            

            <!-- Table -->
            <div class="table-responsive mb-4">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Worker</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Paid Salary</th>
                            <th scope="col">UnPaid Salary</th>
                            <th scope="col">Worked Hours</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                        <tbody>
                            @foreach ($workers->where('monthly_salary_type', 'kpi') as $worker)
                                @foreach ($worker->salary->filter(function ($salary) use ($date) {
                                    return \Carbon\Carbon::parse($salary->date)->format('Y-m') === \Carbon\Carbon::parse($date)->format('Y-m');
                                }) as $salary)
                                    <tr>
                                        <th scope="row">{{ $salary->id }}</th>
                                        <td>{{ $worker->user->name }}</td>
                                        <td>{{ $worker->monthly_salary_amount }}</td>
                                        <td>{{ $salary->paid_amount }}</td>
                                        <td>{{ $salary->unpaid_amount }}</td>
                                        <td>{{ $worker->hours_per_month }}</td>
                                        <td>{{ $salary->date }}</td>
                                        <td>{{ $salary->type }}</td>
                                        {{-- <td>
                                            <button type="button" wire:click="edit({{ $worker->id }})" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click="delete({{ $worker->id }})">Delete</button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        
                </table>
                {{-- {{ $workers->links() }} --}}
            </div>
            @endif

        </section>
    </div>
</div>
