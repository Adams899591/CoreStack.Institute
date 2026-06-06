<?php

use App\Livewire\Students\CurrentSessionFee;
use App\Livewire\Students\PaymentHistory;
use App\Livewire\Students\SemesterGrade;
use App\Livewire\Students\StudentDashboard;
use App\Livewire\Students\StudentPersonalData;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("student")->group(function(){

Route::get('/dashboard', StudentDashboard::class)->name("student.dashboard");
Route::get('/personal-data', StudentPersonalData::class)->name("student.personal-data");
Route::get('/payment-history', PaymentHistory::class)->name("student.payment-history");
Route::get('/current-session-fee', CurrentSessionFee::class)->name("student.current-session-fee");
Route::get('/semester-grade', SemesterGrade::class)->name("student.semester-grade");
});