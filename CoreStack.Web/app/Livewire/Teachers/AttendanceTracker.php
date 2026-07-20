<?php

namespace App\Livewire\Teachers;

use Livewire\Component;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\StudentProfile;
use App\Models\User;

class AttendanceTracker extends Component
{
    public $courses = [];
    public $selectedCourseId;
    public $attendanceLog = [];
    public $enrolledCount = 0;
    public $markedCount = 0;

    public function mount()
    {
        // Fetch courses for the authenticated teacher, fallback to all courses if none/no auth
        $teacherId = auth()->id();
        if ($teacherId) {
            $this->courses = Course::where('teacher_id', $teacherId)->get();
        }
        
        if (empty($this->courses) || $this->courses->isEmpty()) {
            $this->courses = Course::all();
        }

        if ($this->courses->isNotEmpty()) {
            $this->selectedCourseId = $this->courses->first()->id;
            $this->loadAttendanceLog();
        }
    }

    public function updatedSelectedCourseId($value)
    {
        $this->selectedCourseId = $value;
        $this->loadAttendanceLog();
    }

    public function loadAttendanceLog()
    {
        if (!$this->selectedCourseId) {
            $this->attendanceLog = [];
            $this->enrolledCount = 0;
            $this->markedCount = 0;
            return;
        }

        $course = Course::find($this->selectedCourseId);
        if (!$course) {
            return;
        }

        // Fetch attendances for this course today
        $attendances = Attendance::where('course_id', $this->selectedCourseId)
            ->whereDate('attendance_date', today())
            ->latest()
            ->get();

        $this->attendanceLog = $attendances->map(function ($att, $index) {
            $studentUser = User::find($att->user_id);
            $profile = $studentUser ? StudentProfile::where('user_id', $studentUser->id)->first() : null;
            return [
                'index' => str_pad($index + 1, 2, '0', STR_PAD_LEFT),
                'name' => $studentUser->name ?? 'Unknown Student',
                'matric_number' => $profile->matric_number ?? 'N/A',
                'time' => $att->created_at->format('h:i A'),
                'status' => 'Present'
            ];
        })->toArray();

        $this->markedCount = count($this->attendanceLog);

        // Fetch enrolled count: students at the same level and department/faculty
        // Let's approximate based on course level and department
        $this->enrolledCount = StudentProfile::where('level', $course->level)
            ->where('department_id', $course->department_id)
            ->count();

        if ($this->enrolledCount === 0) {
            // Fallback to general students count in the department or database
            $this->enrolledCount = StudentProfile::where('department_id', $course->department_id)->count() ?: StudentProfile::count();
        }
    }

    public function scanBarcode($barcode)
    {
        if (!$this->selectedCourseId) {
            return [
                'status' => 'error',
                'message' => 'Please select a course before scanning.'
            ];
        }

        $course = Course::find($this->selectedCourseId);
        if (!$course) {
            return [
                'status' => 'error',
                'message' => 'Selected course not found.'
            ];
        }

        $barcode = trim($barcode);
        if (empty($barcode)) {
            return [
                'status' => 'error',
                'message' => 'Scan Failed: Scanned code is empty.'
            ];
        }

        // 1. Look up by student matric number or qr_code
        $profile = StudentProfile::where('matric_number', $barcode)
            ->orWhere('qr_code', $barcode)
            ->first();

        // 2. Try looking up by user email, user id or name
        if (!$profile) {
            $user = User::where('email', $barcode)
                ->orWhere('name', $barcode)
                ->first();
            if ($user) {
                $profile = StudentProfile::where('user_id', $user->id)->first();
            }
        }

        // 3. Fallback: Parse common variations or partial match
        if (!$profile) {
            // Check if barcode matches format CSC/2024/001 or has underscores/dashes instead of slashes
            $cleanBarcode = str_replace(['_', '-'], '/', $barcode);
            $profile = StudentProfile::where('matric_number', 'like', "%{$cleanBarcode}%")
                ->orWhere('qr_code', 'like', "%{$cleanBarcode}%")
                ->first();
        }

        if (!$profile || !$profile->user) {
            return [
                'status' => 'error',
                'message' => "Scan Failed: Invalid or unrecognized matric number code '{$barcode}'."
            ];
        }

        $studentUser = $profile->user;

        // Check if already recorded today
        $alreadyMarked = Attendance::where('user_id', $studentUser->id)
            ->where('course_id', $this->selectedCourseId)
            ->whereDate('attendance_date', today())
            ->exists();

        if ($alreadyMarked) {
            return [
                'status' => 'duplicate',
                'message' => "Matric number {$profile->matric_number} has already been recorded.",
                'student' => [
                    'name' => $studentUser->name,
                    'matric_number' => $profile->matric_number ?? 'N/A',
                    'initials' => $this->getInitials($studentUser->name)
                ]
            ];
        }

        // Record attendance
        Attendance::create([
            'user_id' => $studentUser->id,
            'course_id' => $this->selectedCourseId,
            'attendance_date' => today(),
            'status' => 'present',
            'session' => $course->session ?? '2025/2026',
            'semester' => $course->semester ?? 'First',
        ]);

        // Refresh log
        $this->loadAttendanceLog();

        return [
            'status' => 'success',
            'message' => "Success matric number {$profile->matric_number}",
            'student' => [
                'name' => $studentUser->name,
                'matric_number' => $profile->matric_number ?? 'N/A',
                'initials' => $this->getInitials($studentUser->name)
            ]
        ];
    }

    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }

    public function render()
    {
        return view('livewire.teachers.attendance-tracker')->layout("layouts.teachers.app");
    }
}
