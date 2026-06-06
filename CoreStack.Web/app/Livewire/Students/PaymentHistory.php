<?php

namespace App\Livewire\Students;

use Livewire\Component;

class PaymentHistory extends Component
{
    public function render()
    {
        return view('livewire.students.payment-history')->layout("layouts.students.app");
    }
}
