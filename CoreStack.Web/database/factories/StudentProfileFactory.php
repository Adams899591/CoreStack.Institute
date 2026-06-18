<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentProfile>
 */
class StudentProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->student(),
            'legal_name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'nationality' => fake()->country(),
            'state_of_origin' => fake()->state(),
            'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'department_id' => Department::inRandomOrder()->first()?->id ?? Department::factory(),
            'faculty' => "Computing",
            'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
            'enrollment_date' => fake()->date(),
            'admission_year' => (string) fake()->year(),
            'current_gpa' => fake()->randomFloat(2, 1.00, 5.00),
            'profile_image' => null,
            'qr_code' => null,
        ];
    }
}
