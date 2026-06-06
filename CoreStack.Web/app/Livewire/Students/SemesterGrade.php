<?php

namespace App\Livewire\Students;

use Livewire\Component;

class SemesterGrade extends Component
{
    public function render()
    {
        return view('livewire.students.semester-grade')->layout("layouts.students.app");
    }
}
