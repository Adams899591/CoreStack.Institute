<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller{

    public function  login(Request $request){
         
        // Validate the incoming request data
        $validated = $request->validate([
            'matric_number' => 'required|string',
            'password' => 'required|string|min:8'
        ]);


        try {

            $student = StudentProfile::with("Department")->where("matric_number", $validated["matric_number"])->first();

            if (!$student) {
                return response()->json(['status' => 'error', 'message' => 'Invalid matric number or password'], 401);
            }

            if (!$student->user) {
                Log::error("Login failed: Student profile exists but user relationship is null", ['student_id' => $student->id]);
            }

            if (Hash::check($validated["password"], $student->user->password)) {
                // Note:  passing $student make it return all record from the student profile table and the record from the user table
                return response()->json(['status' => 'success', 'message' => 'User logged in successfully', "user" => $student], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid matric number or password'], 401);
            }

        }catch(\Illuminate\Validation\ValidationException $ve) {   // Catch validation exceptions and return a structured error response

            // Return a JSON response with the validation errors and a 422 Unprocessable Entity status code
            return response()->json(['status' => 'error', 
                                      'message' => 'Validation Error: ' ,
                                      'errors' => $ve->errors()
                                      ], 422);

        }catch (\Exception $e) { // Catch any other exceptions and return a generic error response with the exception message
            return response()->json(['status' => 'error', 'message' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }

}
