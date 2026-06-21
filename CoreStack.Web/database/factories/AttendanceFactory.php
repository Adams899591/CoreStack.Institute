<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Department;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. Create a student user
        // $studentUser = User::factory()->student()->create();
        $studentUser = User::where("role", "student")->first();      

        // 2. Create a StudentProfile for this user and get its level
        // We need to ensure a StudentProfile exists for the student.
        // The StudentProfileFactory already generates a random level and admission_year.
        $studentProfile = StudentProfile::factory()->create([
            'user_id' => $studentUser->id,
        ]);
        $studentLevel = $studentProfile->level;

        // 3. Find an existing course that matches the student's level
        $course = Course::where('level', $studentLevel)->inRandomOrder()->first();

        // Fallback: If no course exists for this level, create a dummy one.
        if (!$course) {
            $department = Department::inRandomOrder()->first() ?? Department::factory()->create();
            $teacher = User::where('role', 'teacher')->inRandomOrder()->first() ?? User::factory()->teacher()->create();

            $course = Course::create([
                'department_id' => $department->id,
                'teacher_id' => $teacher->id,
                'course_name' => 'Dummy Course for ' . $studentLevel . 'L',
                'course_code' => 'DUM-' . $studentLevel . '-' . fake()->unique()->randomNumber(3),
                'units' => fake()->numberBetween(2, 4),
                'level' => $studentLevel,
                'semester' => fake()->randomElement(['First', 'Second']),
                'description' => fake()->paragraph(),
                'status' => 'active',
            ]);
        }

        // Determine the current academic session for attendance.
        // Assuming a fixed "current" academic year for all attendance records being generated.
        // This could be made dynamic based on the current date, but for seeding, a fixed value is often sufficient.
        // Based on the previous context, 2025/2026 was used as the base year for 100L.
        // So, let's use '2025/2026' as the session for attendance records being generated.
        $currentAcademicSession = '2025/2026';

        return [
            'user_id' => $studentUser->id,
            'course_id' => $course->id,
            'attendance_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(['present', 'absent']),
            'session' => $currentAcademicSession,
            'semester' => fake()->randomElement(['First', 'Second']),
            'remarks' => fake()->optional()->sentence(),
        ];
    }
}
