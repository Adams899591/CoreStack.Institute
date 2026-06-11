<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtPublishedResults extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-published-results')->layout("layouts.management.app");
    }
}
