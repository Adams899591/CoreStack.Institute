<?php

// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseFactory>
//  */
// class CourseFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             //
//         ];
//     }
// }









namespace Database\Factories;

use App\Models\Course;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    // Static counter to help generate unique course codes sequentially
    protected static $courseCounter = 1;

    public function definition(): array
    {
        // Realistic course data map
        $curriculum = [
            'Web Development' => [
                '100' => ['Introduction to HTML/CSS', 'Internet Fundamentals'],
                '200' => ['JavaScript Basics', 'UI/UX Design for Web'],
                '300' => ['Backend Patterns with PHP', 'Database Management'],
                '400' => ['Advanced Frameworks (Laravel)', 'Fullstack Architecture'],
                '500' => ['Web Security & Scalability', 'Final Web Project'],
            ],
            'Mobile App Development' => [
                '100' => ['Logic and Algorithms', 'Intro to Mobile Tech'],
                '200' => ['Swift & Kotlin Basics', 'Mobile UI Components'],
                '300' => ['API Integration', 'State Management'],
                '400' => ['Cross-Platform Dev (Flutter)', 'App Store Deployment'],
                '500' => ['Mobile Graphics & Games', 'Final App Project'],
            ],
            'Cyber Security' => [
                '100' => ['Computing Ethics', 'Introduction to Networking'],
                '200' => ['Linux Administration', 'Network Protocols'],
                '300' => ['Cryptography', 'Ethical Hacking Fundamentals'],
                '400' => ['Penetration Testing', 'Digital Forensics'],
                '500' => ['Enterprise Security Strategy', 'Security Audit Thesis'],
            ],
            'Data Science' => [
                '100' => ['Calculus & Algebra', 'Introduction to Python'],
                '200' => ['Statistics & Probability', 'Data Structures'],
                '300' => ['Data Visualization', 'SQL for Data Science'],
                '400' => ['Machine Learning Models', 'Big Data Engineering'],
                '500' => ['Predictive Analytics', 'AI Research Paper'],
            ],
            'AI Development' => [
                '100' => ['Discrete Mathematics', 'Programming Logic'],
                '200' => ['Linear Algebra', 'Algorithms for AI'],
                '300' => ['Neural Networks', 'Natural Language Processing'],
                '400' => ['Deep Learning Frameworks', 'Computer Vision'],
                '500' => ['Reinforcement Learning', 'AI Ethics & Capsone'],
            ],
        ];

        // Pick a random department from the database or create one if none exist
        $dept = Department::inRandomOrder()->first() ?? Department::factory()->create();
        $level = fake()->randomElement(['100', '200', '300', '400', '500']);
        
        // Get courses for that dept and level, fallback to a generic name if empty
        $courseNames = $curriculum[$dept->name][$level] ?? ['General Elective'];
        $courseName = fake()->randomElement($courseNames);

        // Generate a code like: WEB-101
        $prefix = strtoupper(substr(str_replace(' ', '', $dept->name), 0, 3));
        $courseCode = $prefix . '-' . $level . '-' . str_pad(self::$courseCounter++, 2, '0', STR_PAD_LEFT);

        return [
            'department_id' => $dept->id,
            'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()?->id ?? User::factory(),
            // 'teacher_id' => User::where('role', 'teacher')->inRandomOrder()->first()?->id ?? User::factory(), 
            // 'department_id' => Department::inRandomOrder()->first()?->id ?? Department::factory(),
            'course_name' => $courseName,
            'course_code' => $courseCode,
            'units' => fake()->numberBetween(2, 4),
            'level' => $level,
            'semester' => fake()->randomElement(['First', 'Second']),
            'description' => fake()->paragraph(),
            'status' => 'active',
        ];
    }
}

















