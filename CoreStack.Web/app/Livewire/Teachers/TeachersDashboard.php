<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class TeachersDashboard extends Component
{
    public function render()
    {
        return view('livewire.teachers.teachers-dashboard')->layout("layouts.teachers.app");
    }
}
