<?php
namespace App\Livewire\Students;

use App\Models\AcademicPeriod;
use App\Models\Course;
use App\Models\Result;
use App\Models\StudentCourseRegistration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;

class CourseRegistration extends Component
{
    // Arrays holding selected course IDs
    public array $selectedCourses = [];        // For Carry-Over courses
    public array $selectedRegularCourses = []; // For Regular semester courses
    // protected $casts = [  // this allowed course id to be looped as array
    // 'course_id' => 'array',
    // ];

    public function mount()
    {
        // Pre-select all regular courses by default when page loads
        $academicPeriod = AcademicPeriod::where("is_current", "true")->first();
        $user = Auth::user()?->StudentProfile;

        if ($academicPeriod && $user) {
            $this->selectedRegularCourses = Course::where("department_id", $user->department_id)
                ->where("semester", $academicPeriod->semester)
                ->where("level", $user->level)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        }
    }

    // Calculate selected carry-over credit units dynamically
    #[Computed]
    public function selectedUnits(): int
    {
        if (empty($this->selectedCourses)) {
            return 0;
        }

        return (int) Course::whereIn('id', $this->selectedCourses)->sum('units');
    }

    // Calculate selected regular credit units dynamically
    #[Computed]
    public function selectedRegularUnits(): int
    {
        if (empty($this->selectedRegularCourses)) {
            return 0;
        }

        return (int) Course::whereIn('id', $this->selectedRegularCourses)->sum('units');
    }

    // Combined credit units (Regular + Carry-Over)
    #[Computed]
    public function combinedTotalUnits(): int
    {
        return $this->selectedRegularUnits + $this->selectedUnits;
    }

    // Toggle All Regular Courses
    public function toggleAllRegular($courseIds)
    {
        if (count($this->selectedRegularCourses) === count($courseIds)) {
            $this->selectedRegularCourses = [];
        } else {
            $this->selectedRegularCourses = array_map('strval', $courseIds);
        }
    }

    // Toggle All Carry-Over Courses
    public function toggleAllFailed($courseIds)
    {
        if (count($this->selectedCourses) === count($courseIds)) {
            $this->selectedCourses = [];
        } else {
            $this->selectedCourses = array_map('strval', $courseIds);
        }
    }

    // public function registerSelectedCourses()
    // {
    //     $this->validate([
    //         'selectedRegularCourses'   => 'nullable|array',
    //         'selectedRegularCourses.*' => 'exists:courses,id',
    //         'selectedCourses'          => 'nullable|array',
    //         'selectedCourses.*'        => 'exists:courses,id',
    //     ]);

    //     $allSelected = array_merge($this->selectedRegularCourses, $this->selectedCourses);

    //     if (empty($allSelected)) { 
    //         $this->addError('selectedCourses', 'Please select at least one course to register.');
    //         return;
    //     }

    //     // --- Your Registration database logic goes here ---

    //     // dd($allSelected);
    //     $academicPeriod = AcademicPeriod::where("is_current", "true")->first();

    //     foreach ($allSelected as $courseId) {
    //         StudentCourseRegistration::create([
    //             "user_id"            => Auth::id(),
    //             "course_id"          => $courseId,
    //             "academic_period_id" => $academicPeriod->id,
    //             "status"             => "registered",
    //         ]);
    //     }


    //     foreach ($allSelected as $courseId) {
    //         Result::create([
    //             "user_id"            => Auth::id(),
    //             "course_id"          => $courseId,
    //             "grade_1"            => null,
    //             "grade_1"            => null,
    //             "grade_2"            => null,
    //             "grade_3"            => null,
    //             "grade_4"            => null,
    //             "exam_score"            => null,
    //             "total_score"            => null,
    //             "grade"            => null,
    //             "credit_units"            =>  0,
    //             "semester"         => $academicPeriod->semester,
    //             "session"            => $academicPeriod->session,
    //             "level"              => Auth::user()->StudentProfile->level,
    //             "visible_to_student"            => false,
    //             "submitted_to_senate"            => false,
    //             "is_carry_over" => 
    //         ]);
    //     }

    //    return  redirect()->route("std.dashboard")->with('message', 'Courses registered successfully!');
    //     // $this->reset(['selectedCourses']);
    // }
    public function registerSelectedCourses()
    {
        $this->validate([
            'selectedRegularCourses'   => 'nullable|array',
            'selectedRegularCourses.*' => 'exists:courses,id',
            'selectedCourses'          => 'nullable|array',
            'selectedCourses.*'        => 'exists:courses,id',
        ]);

        $allSelected = array_merge($this->selectedRegularCourses, $this->selectedCourses);

        if (empty($allSelected)) { 
            $this->addError('selectedCourses', 'Please select at least one course to register.');
            return;
        }

        $academicPeriod = AcademicPeriod::where("is_current", "true")->first();

        foreach ($allSelected as $courseId) {
            StudentCourseRegistration::create([
                "user_id"            => Auth::id(),
                "course_id"          => $courseId,
                "academic_period_id" => $academicPeriod->id,
                "status"             => "registered",
            ]);
        }

        foreach ($allSelected as $courseId) {
            // Determine if the course ID exists in the carry-over selection array
            $isCarryOver = in_array((string) $courseId, array_map('strval', $this->selectedCourses), true);

            Result::create([
                "user_id"              => Auth::id(),
                "course_id"            => $courseId,
                "grade_1"              => null,
                "grade_2"              => null,
                "grade_3"              => null,
                "grade_4"              => null,
                "exam_score"           => null,
                "total_score"          => null,
                "grade"                => null,
                "is_carry_over"        => $isCarryOver,
                "semester"             => $academicPeriod->semester,
                "session"              => $academicPeriod->session,
                "level"                => Auth::user()->StudentProfile->level,
                "visible_to_student"   => false,
                "submitted_to_senate"  => false,
                
            ]);
        }

        return redirect()->route("std.dashboard")->with('message', 'Courses registered successfully!');
    }

    public function render()
    {
        // SECTION 1
        // 1. Get the current academic period
        $academicPeriod = AcademicPeriod::where("is_current", "true")->first();

        // 2. Pass through user profile
        $user = Auth::user()->StudentProfile; 

        // 3. Fetch courses based on department, semester, and level
        $semesterCourses  = Course::where("department_id", $user->department_id)
            ->where("semester", $academicPeriod->semester)
            ->where("level", $user->level)
            ->get();
        
        // 4. Calculate max base total credit units
        $totalUnits = $semesterCourses->sum("units");

        // SECTION 2
        // 1. Fetch failed results for logged-in user
        $result = Result::where("user_id", Auth::id())->where("grade", "F")->get();

        // 2. Extract failed course IDs
        $courseId = $result->pluck("course_id");

        // 3. Fetch courses matching failed IDs
        $failedCourses = Course::whereIn("id", $courseId)->get();

        return view('livewire.students.course-registration', [
            'semesterCourses' => $semesterCourses,
            'failedCourses'   => $failedCourses,
            'totalUnits'      => $totalUnits,
        ])->layout('layouts.students.app');
    }
}