<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentDashboard extends Component
{
    public function render()
    {
        return view('livewire.students.student-dashboard')->layout("layouts.students.app");
    }
}
