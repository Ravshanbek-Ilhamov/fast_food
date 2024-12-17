<div>
    <div class="content-wrapper">
        <section class="content py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Attendance</h2>
            </div>
            @if ($editForm || $createForm)

                <div class="form-group">
                    <label for="date1">Started Time</label>
                    <input type="time" wire:model="started_time" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Ended Time</label>
                    <input type="time" wire:model="ended_time" class="form-control">
                </div>
            
                @if ($createForm)
                    <button class="btn btn-primary" wire:click="storeAttendance">Store</button>
                    <button class="btn btn-primary" wire:click="cancel">Cancel</button>

                @elseif($editForm)
                    <button class="btn btn-primary" wire:click="update">Update</button>
                    <button class="btn btn-primary" wire:click="cancel">Cancel</button>

                @endif
            @endif

            @if (!$editForm && !$createForm)
                
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                @foreach ($days as $day)
                                    <th>{{ $day->format('d') }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody wire:sortable="updateOrder">
                            @foreach ($workers as $worker)
                                <tr>
                                    <th scope="row">{{ $worker->id }}</th>
                                    <td>{{ $worker->user->name }}</td>
                                    @foreach ($days as $day)
                                    @php
                                        $attendance = $this->checkAttendance($worker->id, $day->format('Y-m-d'));
                                    @endphp
                                        @if ($attendance)
                                            <td wire:click="updateAttendance('{{ $worker->id }}', '{{ $day->format('Y-m-d') }}')" 
                                                data-bs-toggle="tooltip" 
                                                title="Start work at: {{$worker->attendance->where('date', $day->format('Y-m-d'))->first()->started_time}}   
                                                    End work at: {{ $worker->attendance->where('date', $day->format('Y-m-d'))->first()->ended_time  ?? 'currently at the work' }}
                                                    Time: {{ $worker->total_hours ?? '' }}
                                                    " style="color: {{ $worker->total_hours <= $attendance->time  ? 'blue' : 'red' }}">{{$attendance->time}}
                                                    @if ($worker->started_time == $attendance->started_time && $worker->ended_time == $attendance->ended_time)
                                                        <span style="color: blue;">+</span>
                                                    @else
                                                        <span style="color: red;">-</span>
                                                    @endif
                                        @else
                                        <td wire:click="createAttendance('{{ $worker->id }}', '{{ $day->format('Y-m-d') }}')" >-</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</div>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Enable tooltips for elements with 'data-bs-toggle="tooltip"'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
