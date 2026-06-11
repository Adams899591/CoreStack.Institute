<?php

namespace App\Livewire\Management;

use Livewire\Component;

class ManagementDashboard extends Component
{
    public function render()
    {
        return view('livewire.management.management-dashboard')->layout("layouts.management.app");
    }
}
