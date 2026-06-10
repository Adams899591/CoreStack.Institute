<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class GradeEntry extends Component
{
    public function render()
    {
        return view('livewire.teachers.grade-entry')->layout("layouts.teachers.app");
    }
}
