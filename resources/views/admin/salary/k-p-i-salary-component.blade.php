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
                
                @if ($editForm)
                    <p class="text-muted"> Unpayed amount: {{ $unpaid_amount }}$ <br>
                        You have to write {{ $paid_amount + $unpaid_amount }}$
                    </p>
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
                            <th scope="col">Bonus</th>
                            <th scope="col">Paid Salary</th>
                            <th scope="col">UnPaid Salary</th>
                            <th scope="col">Worked Hours</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        <tbody>
                            @foreach ($workers->where('monthly_salary_type', 'kpi') as $worker)
                                @foreach ($worker->salary->filter(function ($salary) use ($date) {
                                    return \Carbon\Carbon::parse($salary->date)->format('Y-m') === \Carbon\Carbon::parse($date)->format('Y-m');
                                }) as $salary)
                                    <tr>
                                        <th scope="row">{{ $salary->id }}</th>
                                        <td>{{ $worker->user->name }}</td>
                                        <td>${{ $worker->monthly_salary_amount }}</td>
                                        <td>{{ $worker->bonus }}%</td>
                                        <td>${{ $salary->paid_amount }}</td>
                                        <td>${{ $salary->unpaid_amount }}</td>
                                        <td>{{ $worker->hours_per_month }} Hours</td>
                                        <td>{{ $salary->date }}</td>
                                        <td>{{ $salary->type }}</td>
                                        <td>
                                            <button type="button" wire:click="edit({{ $salary->id }})" class="btn btn-sm btn-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                  </svg>
                                            </button>
                                        </td>
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
