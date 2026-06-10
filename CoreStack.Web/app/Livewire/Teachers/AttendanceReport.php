<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class AttendanceReport extends Component
{
    public function render()
    {
        return view('livewire.teachers.attendance-report')->layout("layouts.teachers.app");
    }
}
