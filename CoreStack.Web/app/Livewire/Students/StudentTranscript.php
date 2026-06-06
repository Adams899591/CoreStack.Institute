<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentTranscript extends Component
{
    public function render()
    {
        return view('livewire.students.student-transcript')->layout("layouts.students.app");
    }
}
