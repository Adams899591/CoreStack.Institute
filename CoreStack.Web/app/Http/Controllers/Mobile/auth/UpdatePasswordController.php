<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function UpdatePassword(Request $request, $userId){
      // 1. Validate incoming payload
       $validated =  $request->validate([
            'password' => 'required|string|min:8',
        ]);

        try {
                   // 2. Find user
                    $user = User::find($userId);

                    if (!$user) {
                        return response()->json([
                            'status'  => 'error',
                            'message' => 'User not found'
                        ], 404);
                    }

                    $user->password = Hash::make($validated["password"]);
                    $user->save();

                    return response()->json([
                            'status'  => 'success',
                            'message' => 'Password updated successfully',
                            // 'user'    => $user
                        ], 200);

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
