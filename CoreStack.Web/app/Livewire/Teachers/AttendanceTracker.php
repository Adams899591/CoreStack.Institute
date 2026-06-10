<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class AttendanceTracker extends Component
{
    public function render()
    {
        return view('livewire.teachers.attendance-tracker')->layout("layouts.teachers.app");
    }
}
