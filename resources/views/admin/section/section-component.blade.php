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
                @if ($editForm)
                    <button class="btn btn-primary" wire:click="update">Update</button>
                @else
                    <button class="btn btn-primary" wire:click="store">Store</button>
                @endif
                <button class="btn btn-primary" wire:click="cancel">Cancel</button>
            @else

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Sections</h2>
                <button type="button" class="btn btn-primary mr-3" wire:click="formCreate">Create</button>
            </div>
            

            <!-- Table -->
            <div class="table-responsive mb-4">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <th scope="row">{{ $section->id }}</th>
                                <td>{{ $section->name }}</td>
                                <td>
                                    <button type="button" wire:click="edit({{ $section->id }})" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $section->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sections->links() }}
            </div>
            @endif
        </section>
    </div>
</div>
