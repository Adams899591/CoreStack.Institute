<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtCourseCatalog extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-course-catalog')->layout("layouts.management.app");
    }
}
