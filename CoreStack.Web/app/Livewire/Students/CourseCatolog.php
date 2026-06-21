<?php

namespace App\Livewire\Students;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseCatolog extends Component
{

  
     
    public function render()
    {
        // 1. get the login user departement id 
        $user = Auth::user()->StudentProfile->department_id;

        // fetch only the courses that is related to the login user
        $courses = Course::where("department_id", $user)->select("level", "semester")->distinct()->get();

        // this helps us to get the count for number of cources for each level
        $count = [

            "100_F" => Course::where('department_id', $user)->where("level", 100)->where("semester", "First")->count(),
            "100_S" =>  Course::where('department_id', $user)->where("level", 100)->where("semester", "Second")->count(),
            "200_F" =>  Course::where('department_id', $user)->where("level", 200)->where("semester", "First")->count(),
            "200_S" =>  Course::where('department_id', $user)->where("level", 200)->where("semester", "Second")->count(),
            "300_F" =>  Course::where('department_id', $user)->where("level", 300)->where("semester", "First")->count(),
            "300_S" =>  Course::where('department_id', $user)->where("level", 300)->where("semester", "Second")->count(),
            "400_F" =>  Course::where('department_id', $user)->where("level", 400)->where("semester", "First")->count(),
            "400_S" =>  Course::where('department_id', $user)->where("level", 400)->where("semester", "Second")->count(),
            "500_F" =>  Course::where('department_id', $user)->where("level", 500)->where("semester", "First")->count(),
            "500_S" =>  Course::where('department_id', $user)->where("level", 500)->where("semester", "Second")->count(),
        ];

        return view('livewire.students.course-catolog', ["courses" => $courses, "count" => $count])->layout("layouts.students.app");
    }
}
