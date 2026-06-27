<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\DegreeClassification;
use App\Models\SemesterResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTranscript extends Component
{
    public function render()
    {

        // set sql_safe_updates = 0;
        // update core_stack_db.semester_results set senate_approved = 0 where session = "2025/2026" and  semester = "Second";

      // 1.  fetch only result that has been approved by senith  
       $semesterResults = SemesterResult::where("user_id", Auth::id())->where("senate_approved", true)->get();
      
      
      $cgpa =  $semesterResults->last()?->cumulative_cgpa; // 2. Extract the user CGPA from $semesterResult

      // 3. check the user CGPA Degree Classification
      $cgpaDegree = DegreeClassification::where('min_cgpa', '<=', $cgpa)->where('max_cgpa', '>=', $cgpa)->first();
    

        return view('livewire.students.student-transcript', ["semesterResults" =>  $semesterResults, "cgpaDegree"  => $cgpaDegree])->layout("layouts.students.app");
    }
}
