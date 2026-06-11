<?php

namespace App\Livewire\Management;

use Livewire\Component;

class ManagementLogin extends Component
{
    public function render()
    {
        return view('livewire.management.management-login')->layout("layouts.auth.app");
    }
}
