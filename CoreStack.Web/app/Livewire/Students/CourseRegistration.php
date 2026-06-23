<?php

namespace App\Livewire\Students;

use Livewire\Component;

class CourseRegistration extends Component
{
    public function render()
    {
        return view('livewire.students.course-registration')->layout("layouts.students.app");
    }
}
