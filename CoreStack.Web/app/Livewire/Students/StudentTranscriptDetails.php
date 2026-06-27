<?php

namespace App\Livewire\Students;

use App\Models\Result;
use App\Models\SemesterResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTranscriptDetails extends Component
{

    // $level and $session are coming from the pass parameter from the Url
    public $semester;
    public $level;  
    public $session;

   public function mount($semester, $level){
      $this->semester = $semester;
      $this->level = $level;
      $this->session = request()->query('session');
   }



    public function render()
    {
       // 1.  fetch the record based on the $semester, $level, $session using the authenticated user id 
       $semesterResult = SemesterResult::where("user_id", Auth::id())->where("semester", $this->semester)->where("level", $this->level)->where("session", $this->session)->first();
        
       // 2.  fetch the record based on the $semester, $level, $session using the authenticated user id 
       $results = Result::with("Course")->where("user_id", Auth::id())->where("semester", $this->semester)->where("level", $this->level)->where("session", $this->session)->get();
       

        return view('livewire.students.student-transcript-details', ["semesterResult" => $semesterResult, "results" => $results, "semester" => $this->semester, "level" => $this->level, "session" => $this->session])->layout("layouts.students.app");
    }
}
