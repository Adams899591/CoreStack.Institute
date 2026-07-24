<?php

namespace App\Http\Controllers\Mobile\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BiometricSetUpController extends Controller
{

    // THIS FUNCTION HANDLES THE ENABLE AND THE DISABLED OF FINGER PRINT
     public function BiometricSetUp(Request $request, $userId){
        // // 1. Validate incoming payload
        $request->validate([
            'enabled' => 'nullable|boolean',
        ]);

        // 2. Find user
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $isEnabled = $request->input('enabled', true);

        if (!$isEnabled) {
            // Generate a secure 60-character random token
            $token = Str::random(25);

            $user->biometric_enabled = true;
            $user->biometric_token   = $token; // Save plain or hash it with hash('sha256', $token)
            $user->save();

            return response()->json([
                'status'          => 'success',
                'message'         => 'Biometric authentication enabled successfully',
                'biometric_token' => $token, // Send back to the mobile app to store securely in Keychain/Keystore
                'user'            => $user
            ], 200);
        } else {
            // Disable biometrics and clear token
            $user->biometric_enabled = false;
            $user->biometric_token   = null;
            $user->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Biometric authentication disabled successfully',
                'user'    => $user
            ], 200);
        }
    }
}


