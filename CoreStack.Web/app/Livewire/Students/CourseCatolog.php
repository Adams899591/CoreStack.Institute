<?php

namespace App\Livewire\Students;

use Livewire\Component;

class CourseCatolog extends Component
{
    public function render()
    {
        return view('livewire.students.course-catolog')->layout("layouts.students.app");
    }
}
