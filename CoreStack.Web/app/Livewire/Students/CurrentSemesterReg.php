<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Attendance;
use App\Models\Result;
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
       $results = Result::with("Course")->where("session", $academicPeriod->session)->where("semester", $academicPeriod->semester)->where("user_id", $userId)->get();
    
       //4 get the total credit unit
       $totalUints = $results->pluck("Course")->sum("units");

        return view('livewire.students.current-semester-reg', ["results" => $results, "totalUints" => $totalUints])->layout("layouts.students.app");
    }
}
 