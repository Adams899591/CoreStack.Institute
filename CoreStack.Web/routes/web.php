<?php

use App\Livewire\Students\CourseCatolog;
use App\Livewire\Students\CourseDetails;
use App\Livewire\Students\CurrentSemesterReg;
use App\Livewire\Students\CurrentSessionFee;
use App\Livewire\Students\PaymentHistory;
use App\Livewire\Students\PreviousRegistration;
use App\Livewire\Students\SemesterGrade;
use App\Livewire\Students\StudentDashboard;
use App\Livewire\Students\StudentLogin;
use App\Livewire\Students\StudentPersonalData;
use App\Livewire\Students\StudentTranscript;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("auth")->group(function(){
    Route::get('/student-login', StudentLogin::class)->name("login");
});


Route::prefix("student")->group(function(){

Route::get('/dashboard', StudentDashboard::class)->name("std.dashboard");
Route::get('/personal-data', StudentPersonalData::class)->name("std.personal-data");
Route::get('/payment-history', PaymentHistory::class)->name("std.payment-history");
Route::get('/current-session-fee', CurrentSessionFee::class)->name("std.current-session-fee");
Route::get('/student-transcript', StudentTranscript::class)->name("std.student-transcript");
Route::get('/current-semester-reg', CurrentSemesterReg::class)->name("std.current-semester-reg");
Route::get('/previous-registration', PreviousRegistration::class)->name("std.previous-registration");
Route::get('/course-catolog', CourseCatolog::class)->name("std.course-catolog");
Route::get('/course-details', CourseDetails::class)->name("std.course-details");

});