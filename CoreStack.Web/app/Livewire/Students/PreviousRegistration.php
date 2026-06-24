<?php

namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Course;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviousRegistration extends Component
{ 
    public function render()
    {

            // 1. fetch all previous Academic Period
            $academicPeriod = AcademicPeriod::where('is_current', "true")->first();

            $userId = Auth::id();  //2. get the user id 

            if (! $academicPeriod) {
                $results = collect(); // empty array [] ifthis dosent work's
            } else {      // 3. fetch the user result that contain all previous semester 
                $results = Result::where('user_id', $userId)
                    ->where(function ($query) use ($academicPeriod) {
                        $query->where('session', '!=', $academicPeriod->session)
                              ->orWhere(function ($q) use ($academicPeriod) {
                                  $q->where('session', $academicPeriod->session)
                                    ->where('semester', "!=", $academicPeriod->semester);
                              });
                    })->select("session", "semester", "level")->distinct()
                    ->get();

                  //4.  get the total count of all the Registered Semesters
                   $totalSemesterReg = $results->pluck("session")->count();

            }
          

        return view('livewire.students.previous-registration', ["results" => $results, "totalSemesterReg" => $totalSemesterReg ])->layout('layouts.students.app');
    }
}
