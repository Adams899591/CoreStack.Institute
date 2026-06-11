<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| DATABASE MIGRATIONS (SCHEMA)
|--------------------------------------------------------------------------
*/

// 1. Users Table (Shared for Student, Teacher, Management)
Schema::create('users', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string('name');
    $blueprint->string('username')->unique(); // Matric Number for Students, Username for others
    $blueprint->string('email')->unique();
    $blueprint->string('password');
    $blueprint->enum('role', ['management', 'teacher', 'student'])->default('student');
    $blueprint->string('profile_image')->nullable();
    $blueprint->rememberToken();
    $blueprint->timestamps();
});

// 2. Departments Table
Schema::create('departments', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string('name');
    $blueprint->string('code')->unique();
    $blueprint->timestamps();
});

// 3. Courses Table
Schema::create('courses', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('department_id')->constrained();
    $blueprint->string('course_name');
    $blueprint->string('course_code')->unique();
    $blueprint->integer('units');
    $blueprint->timestamps();
});

// 4. Fees Table
Schema::create('fees', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string('title'); // e.g., "Tuition Fee 2024"
    $blueprint->decimal('amount', 10, 2);
    $blueprint->string('session'); // e.g., "2023/2024"
    $blueprint->timestamps();
});

// 5. Payments Table (Student Payment History)
Schema::create('payments', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('fee_id')->constrained();
    $blueprint->string('reference_no')->unique();
    $blueprint->decimal('amount_paid', 10, 2);
    $blueprint->enum('status', ['pending', 'completed', 'failed'])->default('completed');
    $blueprint->timestamps();
});

// 6. Registrations Table (Course Registration)
Schema::create('registrations', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->string('semester'); // e.g., "First", "Second"
    $blueprint->string('session');
    $blueprint->timestamps();
});

// 7. Results Table (Transcripts & Grades)
Schema::create('results', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->decimal('score', 5, 2);
    $blueprint->string('grade', 2);
    $blueprint->boolean('is_approved')->default(false); // Management approval
    $blueprint->boolean('is_published')->default(false); // Visible to Student
    $blueprint->timestamps();
});

/*
|--------------------------------------------------------------------------
| MODEL FACTORIES (MOCK DATA GENERATION)
|--------------------------------------------------------------------------
*/

// User Factory
$userFactory = [
    'name' => fake()->name(),
    'email' => fake()->unique()->safeEmail(),
    'password' => bcrypt('password'),
    'role' => fake()->randomElement(['management', 'teacher', 'student']),
    'username' => function (array $attributes) {
        return $attributes['role'] === 'student' 
            ? 'CS-' . date('Y') . '-' . rand(1000, 9999) 
            : fake()->userName();
    },
];

// Department Factory
$departmentFactory = [
    'name' => fake()->company() . ' Department',
    'code' => strtoupper(Str::random(3)),
];

// Course Factory
$courseFactory = [
    'course_name' => fake()->sentence(3),
    'course_code' => strtoupper(fake()->bothify('???###')),
    'units' => fake()->numberBetween(1, 4),
];

// Fee Factory
$feeFactory = [
    'title' => 'Academic Fee ' . fake()->word(),
    'amount' => fake()->randomFloat(2, 5000, 50000),
    'session' => '2023/2024',
];

// Result Factory
$resultFactory = [
    'score' => $score = fake()->numberBetween(30, 95),
    'grade' => $score >= 70 ? 'A' : ($score >= 60 ? 'B' : ($score >= 50 ? 'C' : 'F')),
    'is_approved' => true,
    'is_published' => true,
];









OK I believe you can see all my files boot file both the one
 from the zenith and the one both the one the boot file the app 
 and the mobile and all the each and every file which....umn i am 
 still missing that i haven't do on my database.php what other table i still havent included or 
colume i havent added help me too add them