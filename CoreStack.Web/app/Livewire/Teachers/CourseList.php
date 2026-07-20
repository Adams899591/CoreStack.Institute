<?php

namespace App\Livewire\Teachers;

use App\Models\AcademicPeriod;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseList extends Component
{
    public function render()
    {
        $teacherId = Auth::id(); // 
        $academicPeriod = AcademicPeriod::where('is_current', 'true')->first();

        $coursesQuery = Course::query()
            ->where('teacher_id', $teacherId)
            ->where('status', 'active');

        if ($academicPeriod) {
            $coursesQuery->where('semester', $academicPeriod->semester);
        }

        $courses = $coursesQuery->withCount(['results' => function ($query) use ($academicPeriod) {
            if ($academicPeriod) {
                $query->where('session', $academicPeriod->session)
                    ->where('semester', $academicPeriod->semester)
                    ->where("status", "active");
            }
        }])->get();

        // dd($courses->results_count);
        return view('livewire.teachers.course-list', compact('courses'))->layout('layouts.teachers.app');
    }
}
