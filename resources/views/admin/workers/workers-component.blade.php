<div>
    <div class="content-wrapper">
        <section id="menu" class="content py-4">

            @if ($createForm || $editForm)
                 <!-- Section -->
                 <div class="mb-3">
                    <label for="section_id" class="form-label">Section:</label>
                    <select wire:model.defer="section_id" class="form-control" id="section_id">
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Monthly Salary Type -->
                <div class="mb-3">
                    <label for="monthly_salary_type" class="form-label">Salary Type:</label>
                    <input type="text" wire:model.defer="monthly_salary_type" 
                        class="form-control @error('monthly_salary_type') is-invalid @enderror" id="monthly_salary_type">
                    @error('monthly_salary_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Monthly Salary Amount -->
                <div class="mb-3">
                    <label for="monthly_salary_amount" class="form-label">Salary Amount:</label>
                    <input type="number" wire:model.defer="monthly_salary_amount"
                        class="form-control @error('monthly_salary_amount') is-invalid @enderror" id="monthly_salary_amount">
                    @error('monthly_salary_amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bonus -->
                <div class="mb-3">
                    <label for="bonus" class="form-label">Bonus:</label>
                    <input type="number" wire:model.defer="bonus" 
                        class="form-control @error('bonus') is-invalid @enderror" id="bonus">
                    @error('bonus')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hours Per Month -->
                <div class="mb-3">
                    <label for="hours_per_month" class="form-label">Hours Per Month:</label>
                    <input type="number" wire:model.defer="hours_per_month" 
                        class="form-control @error('hours_per_month') is-invalid @enderror" id="hours_per_month">
                    @error('hours_per_month')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Started Time -->
                <div class="mb-3">
                    <label for="started_time" class="form-label">Started Time:</label>
                    <input type="time" wire:model.defer="started_time" 
                        class="form-control @error('started_time') is-invalid @enderror" id="started_time">
                    @error('started_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ended Time -->
                <div class="mb-3">
                    <label for="ended_time" class="form-label">Ended Time:</label>
                    <input type="time" wire:model.defer="ended_time" 
                        class="form-control @error('ended_time') is-invalid @enderror" id="ended_time">
                    @error('ended_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @if ($editForm)
                    <button class="btn btn-primary" wire:click="update">Update</button>
                @else
                    <button class="btn btn-primary" wire:click="store">Store</button>
                @endif
                <button class="btn btn-primary" wire:click="cancel">Cancel</button>
            @else

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Workers</h2>
                <button type="button" class="btn btn-primary mr-3" wire:click="formCreate">Create</button>
            </div>
            

            <!-- Table -->
            <div class="table-responsive mb-4">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Section</th>
                            <th scope="col">Salary Type</th>
                            <th scope="col">Salary Amount</th>
                            <th scope="col">Bonus</th>
                            <th scope="col">Hours Per Month</th>
                            <th scope="col">Started Time</th>
                            <th scope="col">Ended Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workers as $worker)
                            <tr>
                                <th scope="row">{{ $worker->id }}</th>
                                <td>{{ $worker->section->name }}</td>
                                <td>{{ $worker->monthly_salary_type }}</td>
                                <td>{{ $worker->monthly_salary_amount }}</td>
                                <td>{{ $worker->bonus }}</td>
                                <td>{{ $worker->hours_per_month }}</td>
                                <td>{{ $worker->started_time }}</td>
                                <td>{{ $worker->ended_time }}</td>
                                <td>
                                    <button type="button" wire:click="edit({{ $worker->id }})" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $worker->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $workers->links() }}
            </div>
            @endif

        </section>
    </div>
</div>
