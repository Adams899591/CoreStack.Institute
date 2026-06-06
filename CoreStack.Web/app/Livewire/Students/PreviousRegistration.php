<?php

namespace App\Livewire\Students;

use Livewire\Component;

class PreviousRegistration extends Component
{
    public function render()
    {
        return view('livewire.students.previous-registration')->layout("layouts.students.app");
    }
}
