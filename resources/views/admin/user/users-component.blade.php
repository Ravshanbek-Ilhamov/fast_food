<div>
    <div class="content-wrapper">
        <section id="menu" class="content py-4">

            @if ($createForm || $editForm)
                 <!-- Name -->
                 <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" wire:model.defer="name" 
                        class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" wire:model.defer="email"
                        class="form-control @error('email') is-invalid @enderror" id="email">    
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="text" wire:model.defer="phone" 
                        class="form-control @error('phone') is-invalid @enderror" id="phone">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select wire:model.defer="role_id" class="form-control" id="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div class="form-group">
                    <label for="image" class="form-label">Image:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" wire:model.defer="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" wire:model.defer="password" 
                        class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
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
                <h2>Users</h2>
                <button type="button" class="btn btn-primary mr-3" wire:click="formCreate">Create</button>
            </div>
            

            <!-- Table -->
            <div class="table-responsive mb-4">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Role</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$user->image) }}" alt="User Image" width="50px">
                                </td>
                                <td>
                                    <button type="button" wire:click="edit({{ $user->id }})" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $user->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            @endif

        </section>
    </div>
</div>
