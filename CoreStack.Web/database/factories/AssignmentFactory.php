<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => function () {
                // Ensure a course exists, or create one if not
                return Course::where("semester", "First")->inRandomOrder()->first()->id ?? Course::where("semester", "First")->factory()->create()->id;
            },
            'teacher_id' => function () {
                // Ensure a teacher exists, or create one if not
                return User::where('role', 'teacher')->inRandomOrder()->first()->id
                    ?? User::factory()->teacher()->create()->id;
            },
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'due_date' => fake()->date(),
            'status' => fake()->randomElement(['pending', 'graded', 'closed']),
        ];
    }
}
