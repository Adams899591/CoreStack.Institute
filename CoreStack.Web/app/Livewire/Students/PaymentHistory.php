<?php

namespace App\Livewire\Students;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentHistory extends Component
{
   use WithPagination;



    public function render()
    {
        $user_id = Auth::user()->id; // 1. get the authenticated user 
        $payments = Payment::where("user_id",  $user_id)->where("status", "completed")->get(); //2.  fetch all payment made by that user that has status as completed
        $pending = Payment::where("user_id",  $user_id)->where("status", "pending")->get(); //3. fetch all payment made by that user that has status as pending

        $totalPayment = $payments->sum("amount_paid"); //4.  total amount paid e.g completed
        $outStanding = $pending->sum("amount_paid");  //5.  total amount notpaid e.g pending 

        $lastPayment = Payment::where("user_id",  $user_id)->where("status", "completed")->latest("created_at")->first(); //6. get the latest payment made my the user 
        
        
        return view('livewire.students.payment-history', ["payments" => $payments,  "totalPayment" => $totalPayment, "lastPayment" => $lastPayment,  "outStanding" => $outStanding])->layout("layouts.students.app");
    }
}
