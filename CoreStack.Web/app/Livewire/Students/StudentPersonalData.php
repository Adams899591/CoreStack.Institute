<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentPersonalData extends Component
{
    public function render()
    {
        return view('livewire.students.student-personal-data')->layout("layouts.students.app");
    }
}
