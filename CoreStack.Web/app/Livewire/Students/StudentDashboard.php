<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Payment;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentDashboard extends Component
{ 

    public function render()
    {
       //1.  get the current academic session
       $academicPeriod = AcademicPeriod::where("is_current", "true")->first();

       // 2. check if the user if the user has paid for that academic session or not
       // this only return True or False  
       $hascompletedpayment = Payment::where("user_id", Auth::id())->where("session", $academicPeriod->session)->first();
         
      
       $hasCourseReg = StudentCourseRegistration::where("user_id", Auth::id())->where("academic_period_id", $academicPeriod->id)->exists();

    //    dd($hasCourseReg);
        return view('livewire.students.student-dashboard', ["hascompletedpayment"  => $hascompletedpayment, "hasCourseReg" => $hasCourseReg])->layout("layouts.students.app");
    }
}
