<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class TeacherProfile extends Component
{
    public function render()
    {
        return view('livewire.teachers.teacher-profile')->layout("layouts.teachers.app");
    }
}
