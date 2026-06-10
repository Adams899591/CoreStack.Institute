<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class CourseList extends Component
{
    public function render()
    {
        return view('livewire.teachers.course-list')->layout("layouts.teachers.app");
    }
}
