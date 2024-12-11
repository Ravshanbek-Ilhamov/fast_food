<div>
    <div class="content-wrapper">
        <section id="attendance" class="content py-4">
            @if ($createForm || $editForm)
                <!-- User ID -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input type="number" wire:model.defer="user_id"
                        class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                    @error('user_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Worker ID -->
                <div class="mb-3">
                    <label for="worker_id" class="form-label">Worker ID:</label>
                    <input type="number" wire:model.defer="worker_id"
                        class="form-control @error('worker_id') is-invalid @enderror" id="worker_id">
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
                <!-- Buttons -->
                @if ($editForm)
                    <button class="btn btn-primary" wire:click="update">Update</button>
                @else
                    <button class="btn btn-primary" wire:click="store">Store</button>
                @endif
                <button class="btn btn-secondary" wire:click="cancel">Cancel</button>
            @else
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Attendance Records</h2>
                </div>

                <!-- Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Worker ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Started Time</th>
                                <th scope="col">Ended Time</th>
                                <th scope="col">Total Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <th scope="row">{{ $attendance->id }}</th>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->worker_id }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->started_time }}</td>
                                    <td>{{ $attendance->ended_time }}</td>
                                    <td>{{ $attendance->time }}</td>
                                    <td>
                                        <button type="button" wire:click="edit({{ $attendance->id }})" class="btn btn-sm btn-warning">Edit</button>
                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $attendance->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $attendances->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
