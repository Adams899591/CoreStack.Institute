<?php

namespace App\Livewire\Students;

use Livewire\Component;

class PaymentReceipt extends Component
{
    public function render()
    {
        return view('livewire.students.payment-receipt')->layout("layouts.students.app");
    }
}
