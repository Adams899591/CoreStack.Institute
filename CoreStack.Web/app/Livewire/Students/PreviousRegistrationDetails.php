<?php

namespace App\Livewire\Students;

use Livewire\Component;

class PreviousRegistrationDetails extends Component
{
    public function render()
    {
        return view('livewire.students.previous-registration-details')->layout("layouts.students.app");
    }
}
