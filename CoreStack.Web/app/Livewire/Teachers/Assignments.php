<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class Assignments extends Component
{
    public function render()
    {
        return view('livewire.teachers.assignments')->layout("layouts.teachers.app");
    }
}
