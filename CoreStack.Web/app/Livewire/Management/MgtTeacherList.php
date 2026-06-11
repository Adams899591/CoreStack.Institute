<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtTeacherList extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-teacher-list')->layout("layouts.management.app");
    }
}
