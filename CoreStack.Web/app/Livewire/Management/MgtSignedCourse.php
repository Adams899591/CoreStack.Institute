<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtSignedCourse extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-signed-course')->layout("layouts.management.app");
    }
}
