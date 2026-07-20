<?php

namespace App\Livewire\Teachers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class TeacherLogin extends Component
{   
    
    public string $email = '';
    public string $password = '';


    /**
     * Handle an incoming login request.
     */
    public function TeacherLogin(): void
    {
            $validated = $this->validate([
                'email' => ['required', 'string'],
                'password' => ['required', 'string', Rules\Password::defaults()],
            ]);

            // $student = StudentProfile::where("matric_number", $validated["matric_number"])->first();
            $teacher = User::where("email", $validated["email"])->first();
           
            // 1. Check if the student exists first
            if (!$teacher) {
                $this->addError('email', "Invalid email number or password");
                return; // Stop execution here!
            }

            // 2. Now it is safe to check the password
            if (Hash::check($validated["password"], $teacher->password)) {
                  Auth::login($teacher);
                //  dd($teacher);
             $this->redirectRoute("tchr.dashboard");
              
            } else {
                $this->addError('email', "Invalid email or password");
                return;
            }

    }


    public function render()
    {
        return view('livewire.teachers.teacher-login')->layout("layouts.auth.app");
    }
}
