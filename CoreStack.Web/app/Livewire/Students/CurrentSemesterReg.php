<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\Result;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use StreamBucket;

class CurrentSemesterReg extends Component
{


  
    
    public function render()
    {
       $academicPeriod = AcademicPeriod::where("is_current", "true")->first(); // 1.  get the current academic period

       $userId  = Auth::id(); //2.  get the id of the login user

       // 2. check if the user if the user has paid for that academic session or not
       // this only return True or False 
       $hascompletedpayment = Payment::where("user_id", Auth::id())->where("session", $academicPeriod->session)->first();
    

       $courseIds = StudentCourseRegistration::query()
           ->where("academic_period_id", $academicPeriod->id)
           ->where("user_id", $userId)
           ->pluck("course_id")
           ->all();

       // fetch All courses registered by the user that are of current session (Not Carry Over) 
       $semesterCourses = Result::with("Course")
           ->whereIn("course_id", $courseIds)
           ->where("session", $academicPeriod->session)
           ->where("semester", $academicPeriod->semester)
           ->where("is_carry_over", false)
           ->where("user_id", $userId)
           ->get();

       // fetch All courses registered by the user that are Carry Over Courses
       $CarryOverCourses = Result::with("Course")
           ->whereIn("course_id", $courseIds)
           ->where("session", $academicPeriod->session)
           ->where("semester", $academicPeriod->semester)
           ->where("is_carry_over", true)
           ->where("user_id", $userId)
           ->get();
         

       //4 get the total credit unit
       $totalUints = $semesterCourses->pluck("Course")->sum("units");

        return view('livewire.students.current-semester-reg', [
                    "semesterCourses" => $semesterCourses,
                    "carryOverCourses" => $CarryOverCourses,
                    "totalUints" => $totalUints,
                    "hascompletedpayment" => $hascompletedpayment,
                    ])->layout("layouts.students.app");
    }
}
 