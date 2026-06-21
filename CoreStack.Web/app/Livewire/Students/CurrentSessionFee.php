<?php

namespace App\Livewire\Students;

use App\Models\Fee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CurrentSessionFee extends Component
{
    public function render()
    {
       $user =  Auth::user()->StudentProfile; //1. access the user student profile table to get the department id and the current level

      $academicFee = Fee::where("department_id", $user->department_id)->where("level", $user->level)->first();

        
        return view('livewire.students.current-session-fee', [ "academicFee" =>  $academicFee])->layout("layouts.students.app");
    }
} 
