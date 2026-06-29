<?php

use App\Livewire\Management\ManagementDashboard;
use App\Livewire\Management\ManagementLogin;
use App\Livewire\Management\MgtApprovedResults;
use App\Livewire\Management\MgtCourseCatalog;
use App\Livewire\Management\MgtCourseCrisscross;
use App\Livewire\Management\MgtDepartementManagement;
use App\Livewire\Management\MgtEditStudentDetails;
use App\Livewire\Management\MgtEditTeacherDetails;
use App\Livewire\Management\MgtFeesConfiguration;
use App\Livewire\Management\MgtFeesManagement;
use App\Livewire\Management\MgtPublishedResults;
use App\Livewire\Management\MgtSignedCourse;
use App\Livewire\Management\MgtStudentList;
use App\Livewire\Management\MgtStudentManagement;
use App\Livewire\Management\MgtTeacherList;
use App\Livewire\Students\CourseCatolog;
use App\Livewire\Students\CourseDetails;
use App\Livewire\Students\CourseRegistration;
use App\Livewire\Students\CurrentSemesterReg;
use App\Livewire\Students\CurrentSessionFee;
use App\Livewire\Students\FeeSlipBreakdown;
use App\Livewire\Students\PaymentHistory;
use App\Livewire\Students\PaymentReceipt;
use App\Livewire\Students\PreviousRegistration;
use App\Livewire\Students\PreviousRegistrationDetails;
use App\Livewire\Students\SemesterGrade;
use App\Livewire\Students\StudentDashboard;
use App\Livewire\Students\StudentLogin;
use App\Livewire\Students\StudentPersonalData;
use App\Livewire\Students\StudentTranscript;
use App\Livewire\Students\StudentTranscriptDetails;
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

//  Note => this is your android application id        com.dev_adams.CoreStackApp
// com.dev_adams.CoreStackApp
Route::get('/', function () {
    return view('premium-login');
});


Route::prefix("auth")->group(function(){
    
    Route::get('/student-login', StudentLogin::class)->name("login");
    Route::get('/teacher-login', TeacherLogin::class)->name("teacher-login");
    Route::get('/management-login', ManagementLogin::class)->name("management-login");

});


Route::middleware(["auth", "student"])->prefix("student")->group(function(){

Route::get('/dashboard', StudentDashboard::class)->name("std.dashboard");
Route::get('/personal-data', StudentPersonalData::class)->name("std.personal-data");
Route::get('/payment-history', PaymentHistory::class)->name("std.payment-history");
Route::get('/current-session-fee', CurrentSessionFee::class)->name("std.current-session-fee");
Route::get('/student-transcript', StudentTranscript::class)->name("std.student-transcript");
Route::get('/student-transcript-details/{semester}/{level}', StudentTranscriptDetails::class)->name("std.student-transcript-details");
Route::get('/current-semester-reg', CurrentSemesterReg::class)->name("std.current-semester-reg");
Route::get('/fee-slip-breakdown/{feeAmount}', FeeSlipBreakdown::class)->name("std.fee-slip-breakdown");
Route::get('/payment-receipt', PaymentReceipt::class)->name("std.payment-receipt");
Route::get('/previous-registration', PreviousRegistration::class)->name("std.previous-registration");
Route::get('/course-registration', CourseRegistration::class)->name("std.course-registration");
Route::get('/previous-registration-details/{semester}/{level}', PreviousRegistrationDetails::class)->name("std.previous-registration-details");
Route::get('/course-catolog', CourseCatolog::class)->name("std.course-catolog");
Route::get('/course-details/{level}/{semester}', CourseDetails::class)->name("std.course-details");

});


// middleware(["auth", "teacher"])->
Route::prefix("teacher")->group(function(){

Route::get('/dashboard', TeachersDashboard::class)->name("tchr.dashboard");
Route::get('/grade-entry', GradeEntry::class)->name("tchr.grade-entry");
Route::get('/course-list', CourseList::class)->name("tchr.course-list");
Route::get('/attendance-tracker', AttendanceTracker::class)->name("tchr.attendance-tracker");
Route::get('/attendance-report', AttendanceReport::class)->name("tchr.attendance-report");
Route::get('/teacher-profile', TeacherProfile::class)->name("tchr.teacher-profile");
Route::get('/lecture-materials', LectureMaterials::class)->name("tchr.lecture-materials");
Route::get('/assignments', Assignments::class)->name("tchr.assignments");

});

// middleware(["auth", "management"])->
Route::prefix("management")->group(function(){

Route::get('/dashboard', ManagementDashboard::class)->name("mgt.dashboard");
Route::get('/student-list', MgtStudentList::class)->name("mgt.student-list");
Route::get('/student-management', MgtStudentManagement::class)->name("mgt.student-management");
Route::get('/student-edit', MgtEditStudentDetails::class)->name("mgt.student-edit");
Route::get('/teacher-list', MgtTeacherList::class)->name("mgt.teacher-list");
Route::get('/teacher-edit', MgtEditTeacherDetails::class)->name("mgt.teacher-edit");
Route::get('/course-catalog', MgtCourseCatalog::class)->name("mgt.course-catalog");
Route::get('/course-crisscross', MgtCourseCrisscross::class)->name("mgt.course-crisscross");
Route::get('/approved-results', MgtApprovedResults::class)->name("mgt.approved-results");
Route::get('/published-results', MgtPublishedResults::class)->name("mgt.published-results");
Route::get('/signed-course', MgtSignedCourse::class)->name("mgt.signed-course");
Route::get('/departement-management', MgtDepartementManagement::class)->name("mgt.departement-management");
Route::get('/fees-management', MgtFeesManagement::class)->name("mgt.fees-management");
Route::get("/fee-configuration",MgtFeesConfiguration::class)->name("mgt.fee-configuration");
});