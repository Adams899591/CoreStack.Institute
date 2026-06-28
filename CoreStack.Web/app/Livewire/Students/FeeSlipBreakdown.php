<?php

namespace App\Livewire\Students;

use Livewire\Component;

class FeeSlipBreakdown extends Component
{
    public function render()
    {
        return view('livewire.students.fee-slip-breakdown')->layout("layouts.students.app");
    }
}
