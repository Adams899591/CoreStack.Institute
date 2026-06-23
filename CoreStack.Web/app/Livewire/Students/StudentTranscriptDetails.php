<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentTranscriptDetails extends Component
{
    public function render()
    {
        return view('livewire.students.student-transcript-details')->layout("layouts.students.app");
    }
}
