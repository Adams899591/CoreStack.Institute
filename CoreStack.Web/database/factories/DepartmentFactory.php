<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * The current department index being used by the factory.
     */
    protected static int $departmentIndex = 0;

    /**
     * The list of predefined department names.
     */
    protected static array $departmentNames = [
        'Web Development',
        'Mobile App Development',
        'Cyber Security',
        'Data Science',
        'AI Development',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = self::$departmentNames[self::$departmentIndex % count(self::$departmentNames)];
        $code = Str::upper(Str::slug($name, '-'));

        self::$departmentIndex++;

        return [
            'name' => $name,
            'code' => $code,
        ];
    }
}
