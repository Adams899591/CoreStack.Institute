<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Str;
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
        // Fetch a random department to determine the correct matriculation prefix
        $department = Department::inRandomOrder()->first() ?? Department::factory()->create();

        // Map the department names to your preferred short prefixes
        $prefixes = [
            'Web Development'        => 'WED',
            'Mobile App Development' => 'MAD',
            'Cyber Security'         => 'CYS',
            'Data Science'           => 'DSC',
            'AI Development'         => 'AID',
        ];

        $prefix = $prefixes[$department->name] ?? strtoupper(substr($department->code, 0, 3));

        return [
            'user_id' => User::factory()->student(),
                   'matric_number' => $prefix . '/' . date('Y') . '/' . fake()->unique()->numerify('####'),
     
            // 'legal_name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'nationality' => fake()->country(),
            'state_of_origin' => fake()->state(),
            'marital_status' => fake()->randomElement(['Single', 'Married',]),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'department_id' => $department->id,
            'faculty' => "Computing",
            'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
            'enrollment_date' => fake()->date(),
            'admission_year' => ($year  = fake()->numberBetween(2021, 2025)) . "/" . ($year + 1),
            'current_gpa' => fake()->randomFloat(2, 1.00, 5.00),
            'profile_image' => null,
            'qr_code' => null,
        ];
    }
}
