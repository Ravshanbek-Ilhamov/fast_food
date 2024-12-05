<div>
    <div class="content-wrapper">
        <section class="content py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Categories</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create
                </button>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" wire:model="name" 
                                    class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="order" class="form-label">Order Number:</label>
                                <input type="number" wire:model="order" 
                                    class="form-control @error('order') is-invalid @enderror" id="order">
                                @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" wire:click="store" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Order</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-warning">Edit</button> --}}
                                    <button type="button" wire:click="findEditing('{{$category->id}}')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$category->id}}">
                                        Edit
                                    </button>
                                        <!-- Modal -->
                                        <div wire:ignore.self class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$category->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{$category->id}}">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session('success'))
                                                            <div class="alert alert-success">
                                                                {{ session('success') }}
                                                            </div>
                                                        @endif
                                                        <div class="mb-3">
                                                            <label for="editName{{$category->id}}" class="form-label">Name:</label>
                                                            <input type="text" id="editName{{$category->id}}" 
                                                                wire:model.defer="editingName" 
                                                                class="form-control @error('editingName') is-invalid @enderror">
                                                            @error('editingName')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="editOrder{{$category->id}}" class="form-label">Order Number:</label>
                                                            <input type="number" id="editOrder{{$category->id}}" 
                                                                wire:model.defer="editingOrder" 
                                                                class="form-control @error('editingOrder') is-invalid @enderror">
                                                            @error('editingOrder')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" wire:click="updateCategory">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <button class="btn btn-sm btn-danger" wire:click="delete('{{$category->id}}')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{ $categories->links() }}
            </div>
        </section>
    </div>
    <!-- Button trigger modal -->

  

</div>
