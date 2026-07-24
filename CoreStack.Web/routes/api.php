<?php

use App\Http\Controllers\Mobile\Auth\BiometricLoginController;
use App\Http\Controllers\Mobile\Auth\BiometricSetUpController;
use App\Http\Controllers\Mobile\Auth\LoginController;
use App\Http\Controllers\Mobile\Auth\UpdatePasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Note:    the Router on the Api handles the student Mobile App endpoints
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::prefix("auth")->group(function(){
 
    Route::post('/login', [LoginController::class, "login"]);
    Route::post('/biometric-login', [BiometricLoginController::class, "BiometricLogin"]);
    Route::post('/biometric-setUp/{userId}', [BiometricSetUpController::class, "BiometricSetUp"]);
    Route::post('/update-password/{userId}', [UpdatePasswordController::class, "UpdatePassword"]);

});