<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiometricLoginController extends Controller
{
    public function BiometricLogin(Request $request)
    {
        Log::info('Biometric login request received', $request->all());

        // 1. Validate incoming request
        $validated = $request->validate([
            'biometric_token' => 'required|string',
        ]);

        try {
            // 2. Find the student where the related User matches the biometric token
            $student = StudentProfile::with(['Department', 'User'])
                ->whereHas('User', function ($query) use ($validated) {
                    $query->where('biometric_token', $validated['biometric_token']);
                })
                ->first();

            // 3. If no student profile/user matches the token
            if (!$student || !$student->user) {
                Log::info("Biometric login failed: Token not found or user invalid.");
                return response()->json([
                    'status'  => 'error', 
                    'message' => 'Invalid or unrecognized biometric token.'
                ], 401);
            }

            // 4. Success Response
            return response()->json([
                'status'  => 'success',
                'message' => 'User logged in successfully',
                'user'    => $student
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'status'  => 'error', 
                'message' => 'Validation Error',
                'errors'  => $ve->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error("Biometric Login Server Error: " . $e->getMessage());
            return response()->json([
                'status'  => 'error', 
                'message' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
}