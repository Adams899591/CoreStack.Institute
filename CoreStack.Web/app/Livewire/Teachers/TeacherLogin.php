<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class TeacherLogin extends Component
{
    public function render()
    {
        return view('livewire.teachers.teacher-login')->layout("layouts.auth.app");
    }
}
