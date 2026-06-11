<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtEditTeacherDetails extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-edit-teacher-details')->layout("layouts.management.app");
    }
}
