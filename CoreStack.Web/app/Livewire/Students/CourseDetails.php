<?php

namespace App\Livewire\Students;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseDetails extends Component
{
    // $level and $semester are coming from the pass parameter from the Url
    public $level;  
    public $semester; 

   public function mount($level, $semester){
     $this->level = $level;
     $this->semester = $semester;
   }


 
    public function render()
    {
        // 1. get the login user departement id 
        $userDepartement = Auth::user()->StudentProfile->department_id;

        // 2. fetch the course base on thd user departement the passed levele and the passed semester
        $courses =  Course::where("department_id", $userDepartement)->where("level", $this->level)->where("semester", $this->semester)->get();

        // 3. count the total credit unit unit
        $totalCreditUnit = $courses->sum("units");


        return view('livewire.students.course-details', ["courses" => $courses, "totalCreditUnit" => $totalCreditUnit, "level" => $this->level, "semester" => $this->semester])->layout("layouts.students.app");
    }
}
