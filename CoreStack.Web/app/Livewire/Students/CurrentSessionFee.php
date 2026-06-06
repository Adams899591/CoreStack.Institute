<?php

namespace App\Livewire\Students;

use Livewire\Component;

class CurrentSessionFee extends Component
{
    public function render()
    {
        return view('livewire.students.current-session-fee')->layout("layouts.students.app");
    }
}
