<?php

namespace App\Livewire\Students;

use Livewire\Component;

class CurrentSemesterReg extends Component
{
    public function render()
    {
        return view('livewire.students.current-semester-reg')->layout("layouts.students.app");
    }
}
 