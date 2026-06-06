<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentLogin extends Component
{
    public function render()
    {
        return view('livewire.students.student-login')->layout("layouts.auth.app");
    }
}
