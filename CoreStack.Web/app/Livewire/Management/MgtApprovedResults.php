<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtApprovedResults extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-approved-results')->layout("layouts.management.app");
    }
}
