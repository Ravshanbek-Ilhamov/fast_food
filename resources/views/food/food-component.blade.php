<div>
    <div class="content-wrapper">
        <section class="content py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Foods</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleFoodModal">
                    Create
                </button>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="exampleFoodModal" tabindex="-1" aria-labelledby="exampleFoodModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleFoodModalLabel">Add New Category</h5>
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
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" wire:model="price"
                                    class="form-control @error('price') is-invalid @enderror" id="price">    
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Image" class="form-label">Image:</label>
                                <input type="file" wire:model="image_path"
                                    class="form-control @error('image_path') is-invalid @enderror" id="Image_path">    
                                @error('image_path')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="SelectCategory" class="form-label">Select Category:</label>
                                <select wire:model="category_id" class="form-select" id="SelectCategory">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                            <tr>
                                <th scope="row">{{ $food->id }}</th>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->price }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$food->image_path) }}" alt="" width="50px">
                                </td>
                                <td>{{ $food->category->name }}</td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-warning">Edit</button> --}}
                                    <button type="button" wire:click="findEditing('{{$food->id}}')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalFood{{$food->id}}">
                                        Edit
                                    </button>
                                        <!-- Modal -->
                                        <div wire:ignore.self class="modal fade" id="exampleModalFood{{$food->id}}" tabindex="-1" aria-labelledby="exampleModalLabelFood{{$food->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabelFood{{$food->id}}">Edit Food</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session('success'))
                                                            <div class="alert alert-success">
                                                                {{ session('success') }}
                                                            </div>
                                                        @endif
                                                        <div class="mb-3">
                                                            <label for="editingname" class="form-label">Name:</label>
                                                            <input type="text" wire:model.defer="editingname" 
                                                                class="form-control @error('editingname') is-invalid @enderror" id="editingname">
                                                            @error('editingname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                            
                                                        <div class="mb-3">
                                                            <label for="editingprice" class="form-label">Price:</label>
                                                            <input type="number" wire:model.defer="editingprice"
                                                                class="form-control @error('editingprice') is-invalid @enderror" id="editingprice">    
                                                            @error('editingprice')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                            
                                                        <div class="mb-3">
                                                            <label for="editingimage" class="form-label">Image:</label>
                                                            <input type="file" wire:model="editingimage"
                                                                class="form-control @error('editingimage') is-invalid @enderror" id="editingimage">    
                                                                @if ($editingimage)
                                                                    <img src="storage/{{ $editingimage}}" Width="50px" alt="image">
                                                                @endif
                                                                @error('editingimage')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </div>
                            
                                                        <div class="mb-3">
                                                            <label for="editSelectCategory" class="form-label">Select Category:</label>
                                                            <select wire:model.defer="editingcategory_id" class="form-select" id="editSelectCategory">
                                                                @foreach ($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('editingcategory_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror   
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" wire:click="updatefood">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <button class="btn btn-sm btn-danger" wire:click="delete('{{$food->id}}')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{ $foods->links() }}
            </div>
        </section>
    </div>
    <!-- Button trigger modal -->

  

</div>
