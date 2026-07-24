<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiometricLoginController extends Controller
{
    public function BiometricLogin(Request $request){

        // Validate the incoming request data
        $validated = $request->validate([
            'biometric_token' => 'required|string',
        ]);


        try {

            $student = StudentProfile::with("Department")->first();

            if (!$student) {
                return response()->json(['status' => 'error', 'message' => 'Invalid matric number or password'], 401);
            }

            if (!$student->user) {
                Log::error("Login failed: Student profile exists but user relationship is null", ['student_id' => $student->id]);
            }

            if ($student->user->biometric_token == $validated["biometric_token"]) {
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
