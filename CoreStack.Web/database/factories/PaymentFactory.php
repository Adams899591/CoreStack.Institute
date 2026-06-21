<?php

namespace Database\Factories;

use App\Models\Fee;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::where('role', 'student')->inRandomOrder()->first()->id;
                    // ?? User::factory()->student()->create()->id;
            },
            'fee_id' => function (array $attributes) {
                $profile = StudentProfile::where('user_id', $attributes['user_id'])->first();
                return Fee::where('department_id', $profile?->department_id)
                    ->where('level', $profile?->level)
                    ->inRandomOrder()->first()?->id ?? Fee::factory()->create()->id;
            },
            'reference_no' => strtoupper(fake()->unique()->bothify('PAY-#####')),
            'amount_paid' => function (array $attributes) {
                return Fee::find($attributes['fee_id'])->amount ?? 0;
            },
            'session' => function (array $attributes) {
                return Fee::find($attributes['fee_id'])->session ?? '2023/2024';
            },
            'semester' => 'First',
            'payment_date' => fake()->date(),
            'status' => 'completed',
        ];
    }
}
