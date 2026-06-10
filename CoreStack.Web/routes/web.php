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
use App\Livewire\Teachers\Assignments;
use App\Livewire\Teachers\AttendanceReport;
use App\Livewire\Teachers\AttendanceTracker;
use App\Livewire\Teachers\CourseList;
use App\Livewire\Teachers\GradeEntry;
use App\Livewire\Teachers\LectureMaterials;
use App\Livewire\Teachers\TeacherLogin;
use App\Livewire\Teachers\TeacherProfile;
use App\Livewire\Teachers\TeachersDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("auth")->group(function(){
    Route::get('/student-login', StudentLogin::class)->name("login");
    Route::get('/teacher-login', TeacherLogin::class)->name("teacher-login");
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



Route::prefix("teachers")->group(function(){

Route::get('/dashboard', TeachersDashboard::class)->name("tchr.dashboard");
Route::get('/grade-entry', GradeEntry::class)->name("tchr.grade-entry");
Route::get('/course-list', CourseList::class)->name("tchr.course-list");
Route::get('/attendance-tracker', AttendanceTracker::class)->name("tchr.attendance-tracker");
Route::get('/attendance-report', AttendanceReport::class)->name("tchr.attendance-report");
Route::get('/teacher-profile', TeacherProfile::class)->name("tchr.teacher-profile");
Route::get('/lecture-materials', LectureMaterials::class)->name("tchr.lecture-materials");
Route::get('/assignments', Assignments::class)->name("tchr.assignments");

});