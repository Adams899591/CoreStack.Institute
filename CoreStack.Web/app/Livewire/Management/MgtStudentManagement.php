<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtStudentManagement extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-student-management')->layout("layouts.management.app");
    }
}
