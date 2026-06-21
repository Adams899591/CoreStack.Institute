<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Result::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $course = Course::inRandomOrder()->first() ?: Course::factory()->create();
        $student = User::where('role', 'student')->inRandomOrder()->first() ?: User::factory()->student()->create();

        $grade1 = fake()->numberBetween(5, 25);
        $grade2 = fake()->numberBetween(5, 25);
        $grade3 = fake()->numberBetween(5, 25);
        $score = fake()->numberBetween(20, 70);
        $totalScore = min(100, $grade1 + $grade2 + $grade3 + $score);

        return [
            'user_id' => $student->id,
            'course_id' => $course->id,
            'grade_1' => $grade1,
            'grade_2' => $grade2,
            'grade_3' => $grade3,
            'score' => $score,
            'total_score' => $totalScore,
            'grade' => $this->totalScoreToLetterGrade($totalScore),
            'approved' => fake()->boolean(80),
            'pending' => fake()->boolean(10),
        ];
    }

    private function totalScoreToLetterGrade(int $totalScore): string
    {
        return match (true) {
            $totalScore >= 70 => 'A',
            $totalScore >= 60 => 'B',
            $totalScore >= 50 => 'C',
            $totalScore >= 45 => 'D',
            $totalScore >= 40 => 'E',
            default => 'F',
        };
    }
}
