<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component; 

class CurrentSessionFee extends Component
{
    public function render()
    {
       $user =  Auth::user()->StudentProfile; //1. access the user student profile table to get the department id and the current level

       //2. get the student school fees based on the departement, level and active status from the the fee table
      $academicFee = Fee::where("department_id", $user->department_id)->where("level", $user->level)->where("status", "active")->first();

      // 1.  get the current academic period
      $academicPeriod = AcademicPeriod::where("is_current", "true")->first(); 

      //2. Check if the user has a payment of that academy session  Note: this return true of false 
      $payment = Payment::where("user_id", Auth::id())->where("session", $academicPeriod->session)->first();
    
      
        return view('livewire.students.current-session-fee', [ 
                    "academicFee" =>  $academicFee,
                    "payment" => $payment
                    ])->layout("layouts.students.app");
    }
} 
