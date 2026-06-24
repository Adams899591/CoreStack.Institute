<?php

namespace App\Livewire\Students;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviousRegistrationDetails extends Component
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
        // 1. fetch records from the Result based on the passed parameters $result, $session, $semester using the login user id to display the previous registration details 
        $results = Result::with("Course")->where("user_id", Auth::id())->where("semester", $this->semester)->where("session", $this->session)->where("level", $this->level)->get();

        return view('livewire.students.previous-registration-details', ["results" =>  $results, "session" => $this->session, "level" => $this->level, "semester"  => $this->semester])->layout("layouts.students.app");
    }
}
