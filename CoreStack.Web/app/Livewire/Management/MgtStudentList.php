<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtStudentList extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-student-list')->layout("layouts.management.app");
    }
}
