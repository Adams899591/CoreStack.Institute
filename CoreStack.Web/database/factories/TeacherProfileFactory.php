<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherProfile>
 */
class TeacherProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->teacher(),
            'legal_name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'nationality' => fake()->country(),
            'state_of_origin' => fake()->state(),
            'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'department_id' => null,
            'faculty' => fake()->word(),
            'designation' => fake()->jobTitle(),
            'employment_date' => fake()->date(),
            'profile_image' => null,
        ];
    }
}
