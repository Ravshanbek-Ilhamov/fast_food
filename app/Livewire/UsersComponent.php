<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $editing, $createForm = false, $editForm = false;
    public $roles, $name, $email, $password, $role_id, $phone, $image_path, $image;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $users = User::paginate(10);
        $this->roles = \App\Models\Role::all();

        return view('admin.user.users-component', ['users' => $users])
            ->layout('components.layouts.admin');
    }

    public function findEditing($id)
    {
        $this->editing = User::findOrFail($id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user->image_path) {
            FacadesStorage::delete('public/' . $user->image_path);
        }
        $user->delete();

        session()->flash('success', 'User deleted successfully!');
    }

    public function formCreate()
    {
        $this->resetForm();
        $this->createForm = true;
    }

    public function cancel()
    {
        $this->resetForm();
        $this->createForm = false;
        $this->editForm = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filePath = $this->image->store('users', 'public');

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role_id,
            'phone_number' => $this->phone,
            'image_path' => $filePath,
        ]);

        session()->flash('success', 'User created successfully!');
        $this->cancel();
    }

    public function edit(User $user)
    {
        $this->editing = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        $this->phone = $user->phone_number;
        $this->image_path = $user->image_path;

        $this->createForm = false;
        $this->editForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->editing->id,
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filePath = $this->editing->image_path;

        if ($this->image) {
            $filePath = $this->image->store('users', 'public');
        }

        $this->editing->update([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'phone_number' => $this->phone,
            'image_path' => $filePath,
        ]);

        if ($this->password) {
            $this->editing->update([
                'password' => Hash::make($this->password),
            ]);
        }

        session()->flash('success', 'User updated successfully!');
        $this->cancel();
    }

    private function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role_id', 'phone', 'image', 'image_path', 'editing']);
    }
}
