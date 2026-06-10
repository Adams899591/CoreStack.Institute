<?php

namespace App\Livewire\Teachers;

use Livewire\Component;

class LectureMaterials extends Component
{
    public function render()
    {
        return view('livewire.teachers.lecture-materials')->layout("layouts.teachers.app");
    }
}
