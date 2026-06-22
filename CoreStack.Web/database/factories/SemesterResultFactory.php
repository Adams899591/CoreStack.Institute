<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SemesterResult>
 */
class SemesterResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\SemesterResult::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = User::where('role', 'student')->inRandomOrder()->first() ?: User::factory()->student()->create();
        $profile = StudentProfile::where('user_id', $student->id)->first() ?: StudentProfile::factory()->create(['user_id' => $student->id]);
        $payment = Payment::where('user_id', $student->id)->inRandomOrder()->first() ?: Payment::factory()->create(['user_id' => $student->id]);

        $gpa = fake()->randomFloat(2, 1.00, 5.00);
        $totalUnitsRegistered = fake()->randomFloat(1, 12, 24);
        $totalUnitsPassed = fake()->randomFloat(1, 0, $totalUnitsRegistered);
        $totalTgp = round($gpa * $totalUnitsRegistered, 2);

        return [
            'user_id' => $student->id,
            'student_profile_id' => $profile->id,
            'payment_id' => $payment->id,
            'semester' => $payment->semester ?: fake()->randomElement(['First', 'Second']),
            'session' => $payment->session,
            'level' => $profile->level,
            'grade_point' => round($gpa, 2),
            'total_grade_point' => $totalTgp,
            'total_units_registered' => round($totalUnitsRegistered, 1),
            'total_units_passed' => round($totalUnitsPassed, 1),
            'grade_point_average_gpa' => round($gpa, 2),
            'credit_units' => round($totalUnitsRegistered, 1), // CU: Snapshot of course units from courses table
            'total_tgp' => $totalTgp,
            'cumulative_cgpa' => round(min(5.00, max(0.00, $gpa + fake()->randomFloat(2, 0.10, 0.50))) / 1.1, 2),
            'last_cumulative_cgpa' => round(max(0.00, $gpa - fake()->randomFloat(2, 0.10, 0.50)), 2), // Simulated previous CGPA snapshot
            'is_approved' => fake()->boolean(70),
            'is_published' => fake()->boolean(50),
        ];
    }
}
