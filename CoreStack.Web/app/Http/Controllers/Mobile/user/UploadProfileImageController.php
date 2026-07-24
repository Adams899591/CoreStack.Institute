<?php

namespace App\Http\Controllers\Mobile\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UploadProfileImageController extends Controller
{
    public function UploadProfileImage(Request $request, $userId){
        // Validate the incoming request data
        $validated = $request->validate([
            'profile_url' => 'required|string',
            'profile_public_id' => 'required|string'
        ]);


        // 2. Find user
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found'
            ], 404);
        }


        
        $user->profile_url = $validated["profile_url"];
        $user->profile_public_id  = $validated["profile_public_id"];
        $user->save();

        return response()->json([
            'status'          => 'success',
            'message'         => "User Profile Updated Successfuly",
            'user'            => $user
        ], 200);







    }
}
