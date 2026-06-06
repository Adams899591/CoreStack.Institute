<?php

namespace App\Livewire\Students;

use Livewire\Component;

class CourseDetails extends Component
{
    public function render()
    {
        return view('livewire.students.course-details')->layout("layouts.students.app");
    }
}
