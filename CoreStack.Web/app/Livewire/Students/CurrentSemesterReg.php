<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Attendance;
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

       //3. fetch the result based on the academic session, semester and the login user id
    //    $results = Result::with("Course")->where("session", $academicPeriod->session)->where("semester", $academicPeriod->semester)->where("user_id", $userId)->get();
                

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
                    "totalUints" => $totalUints
                    ])->layout("layouts.students.app");
    }
}
 