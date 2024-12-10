<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionComponent extends Component
{

    use WithPagination;


    public $editing, $createForm = false, $editForm = false;
    public $name;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $sections = Section::paginate(10);
        return view('admin.section.section-component',['sections' => $sections])->layout('components.layouts.admin');
    }

    public function findEditing($id)
    {
        $this->editing = Section::findOrFail($id);
    }

    public function delete($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        session()->flash('success', 'Section deleted successfully!');
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
        ]);
        Section::create(['name' => $this->name]);

        session()->flash('success', 'User created successfully!');
        $this->cancel();
    }

    public function edit(Section $section)
    {
        $this->editing = $section;
        $this->name = $section->name;

        $this->createForm = false;
        $this->editForm = true;
    }

    public function update()
    {
        $this->validate(['name' => 'required|string|max:255']);

        $this->editing->update(['name' => $this->name]);

        session()->flash('success', 'User updated successfully!');
        $this->cancel();
    }

    private function resetForm()
    {
        $this->reset(['name', 'editing']);
    }
}
