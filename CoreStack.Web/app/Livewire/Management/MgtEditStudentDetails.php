<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtEditStudentDetails extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-edit-student-details')->layout("layouts.management.app");
    }
}
