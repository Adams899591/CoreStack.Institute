<?php

namespace App\Livewire\Management;

use Livewire\Component;

class MgtFeesManagement extends Component
{
    public function render()
    {
        return view('livewire.management.mgt-fees-management')->layout("layouts.management.app");
    }
}
