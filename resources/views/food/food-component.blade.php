<div>
    <div class="content-wrapper">
        <section  id="menu" class="content py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Foods</h2>
                <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#exampleFoodModal">
                    Create
                </button>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="exampleFoodModal" tabindex="-1" role="dialog" aria-labelledby="exampleFoodModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleFoodModalLabel">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" wire:model.blur="name" 
                                    class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" wire:model.blur="price"
                                    class="form-control @error('price') is-invalid @enderror" id="price">    
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image_path') is-invalid @enderror" id="Image_path" wire:model.blur="image_path">
                                        <label class="custom-file-label" for="Image_path">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('image_path')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Preview Section -->
                            <div class="mt-3">
                                <label for="Image" class="form-label">Image Preview:</label>
                                @if ($image_path)
                                    <img src="{{ asset('storage/' . $image_path) }}" alt="Uploaded Image" class="img-thumbnail" style="max-height: 200px;">
                                @else
                                    <p>No image selected</p>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label for="SelectCategory" class="form-label">Select Category:</label>
                                <select wire:model.blur="category_id" class="form-control" id="SelectCategory">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" wire:click="store" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive mb-4" >
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
                                    <button type="button" wire:click="findEditing('{{$food->id}}')" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalFood{{$food->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                    </button>
                                    <!-- Modal -->
                                    <div wire:ignore.self class="modal fade" id="exampleModalFood{{$food->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelFood{{$food->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelFood{{$food->id}}">Edit Food</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
                                                    <div class="mb-3">
                                                        <label for="editingname" class="form-label">Name:</label>
                                                        <input type="text" wire:model.blur.defer="editingname" 
                                                            class="form-control @error('editingname') is-invalid @enderror" id="editingname">
                                                        @error('editingname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editingprice" class="form-label">Price:</label>
                                                        <input type="number" wire:model.blur.defer="editingprice"
                                                            class="form-control @error('editingprice') is-invalid @enderror" id="editingprice">    
                                                        @error('editingprice')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editingimage" class="form-label">Image:</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input @error('editingimage') is-invalid @enderror" id="editingimage" wire:model.blur="editingimage">
                                                                <label class="custom-file-label" for="editingimage">Choose file</label>
                                                            </div>
                                                        </div>
                                                        @if ($editingimage)
                                                            <div class="mt-3">
                                                                <img src="{{ asset('storage/' . $editingimage) }}" alt="image"  style="width: 50px;">
                                                            </div>
                                                        @endif
                                                        @error('editingimage')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="editSelectCategory" class="form-label">Select Category:</label>
                                                        <select wire:model.blur.defer="editingcategory_id" class="form-control" id="editSelectCategory">
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" wire:click="updatefood">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-sm btn-danger" wire:click="delete('{{$food->id}}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                          </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $foods->links() }}
        </section>
    </div>
</div>
