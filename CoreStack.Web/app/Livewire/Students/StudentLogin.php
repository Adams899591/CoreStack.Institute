<?php

namespace App\Livewire\Students;

// use Illuminate\Support\Facades\Password;

use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
// use Rules\Password;

class StudentLogin extends Component
{

    public string $matric_number = '';
    public string $password = '';


    /**
     * Handle an incoming login request.
     */
    public function StudentLogin(): void
    {
            $validated = $this->validate([
                'matric_number' => ['required', 'string'],
                'password' => ['required', 'string', Rules\Password::defaults()],
            ]);

            $student = StudentProfile::where("matric_number", $validated["matric_number"])->first();
           
            // 1. Check if the student exists first
            if (!$student) {
                $this->addError('matric_number', "Invalid matric number or password");
                return; // Stop execution here!
            }

            // 2. Now it is safe to check the password
            if (Hash::check($validated["password"], $student->user->password)) {
                  Auth::login($student->user);
                //  dd($student->user);
             $this->redirectRoute("std.dashboard");
              
            } else {
                $this->addError('matric_number', "Invalid matric number or password");
                return;
            }

    }


    public function render()
    {
        return view('livewire.students.student-login')->layout("layouts.auth.app");
    }
}
