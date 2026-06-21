<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
 
/*
|--------------------------------------------------------------------------
| DATABASE MIGRATIONS (SCHEMA)
|--------------------------------------------------------------------------
*/


// 1. Users Table (Login / Auth Only)
Schema::create('users', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string('name');
    $blueprint->string('username')->unique();
    $blueprint->string('email')->unique();
    $blueprint->string('password');
    $blueprint->string('matric_number')->nullable()->unique();
    $blueprint->enum('role', ['management', 'teacher', 'student'])->default('student');
    $blueprint->boolean('biometric_enabled')->default(false);
    $blueprint->string('biometric_token')->nullable();
    $blueprint->enum('status', ['active', 'inactive'])->default('active');
    $blueprint->rememberToken();
    $blueprint->timestamps();
});

// 2. Student Profiles Table
Schema::create('student_profiles', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
    $blueprint->string('legal_name')->nullable();
    $blueprint->date('date_of_birth')->nullable();
    $blueprint->enum('gender', ['Male', 'Female', 'Other'])->nullable();
    $blueprint->string('nationality')->nullable();
    $blueprint->string('state_of_origin')->nullable();
    $blueprint->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed'])->nullable();
    $blueprint->string('phone')->nullable();
    $blueprint->text('address')->nullable();
    $blueprint->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
    $blueprint->string('faculty')->nullable();
    $blueprint->string('level')->nullable();
    $blueprint->date('enrollment_date')->nullable();
    $blueprint->string('admission_year')->nullable();
    $blueprint->decimal('current_gpa', 4, 2)->nullable();
    $blueprint->string('profile_image')->nullable();
    $blueprint->string('qr_code')->nullable()->unique();
    $blueprint->timestamps();
});

// 3. Teacher Profiles Table
Schema::create('teacher_profiles', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
    $blueprint->string('legal_name')->nullable();
    $blueprint->date('date_of_birth')->nullable();
    $blueprint->enum('gender', ['Male', 'Female', 'Other'])->nullable();
    $blueprint->string('nationality')->nullable();
    $blueprint->string('state_of_origin')->nullable();
    $blueprint->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed'])->nullable();
    $blueprint->string('phone')->nullable();
    $blueprint->text('address')->nullable();
    $blueprint->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
    $blueprint->string('faculty')->nullable();
    $blueprint->string('designation')->nullable();
    $blueprint->date('employment_date')->nullable();
    $blueprint->string('profile_image')->nullable();
    $blueprint->timestamps();
});

// 4. Management Profiles Table
Schema::create('management_profiles', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
    $blueprint->string('legal_name')->nullable();
    $blueprint->string('phone')->nullable();
    $blueprint->text('address')->nullable();
    $blueprint->string('designation')->nullable();
    $blueprint->string('profile_image')->nullable();
    $blueprint->timestamps();
});

// // 1. Users Table (Shared for Student, Teacher, Management)
// Schema::create('users', function (Blueprint $blueprint) {
//     $blueprint->id();
//     $blueprint->string('name');
//     $blueprint->string('username')->unique(); // login alias / matric number for students
//     $blueprint->string('email')->unique();
//     $blueprint->string('password');
//     $blueprint->string('legal_name')->nullable();
//     $blueprint->string('matric_number')->nullable()->unique();
//     $blueprint->string('teacher_id')->nullable()->unique();
//     $blueprint->enum('role', ['management', 'teacher', 'student'])->default('student');
//     $blueprint->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
//     $blueprint->string('faculty')->nullable();
//     $blueprint->string('designation')->nullable();
//     $blueprint->date('date_of_birth')->nullable();
//     $blueprint->enum('gender', ['Male', 'Female', 'Other'])->nullable();
//     $blueprint->string('nationality')->nullable();
//     $blueprint->string('state_of_origin')->nullable();
//     $blueprint->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed'])->nullable();
//     $blueprint->string('phone')->nullable();
//     $blueprint->text('address')->nullable();
//     $blueprint->string('level')->nullable();
//     $blueprint->date('enrollment_date')->nullable();
//     $blueprint->string('admission_year')->nullable();
//     $blueprint->decimal('current_gpa', 4, 2)->nullable();
//     $blueprint->boolean('biometric_enabled')->default(false);
//     $blueprint->string('biometric_token')->nullable();
//     $blueprint->date('employment_date')->nullable();
//     $blueprint->enum('status', ['active', 'inactive'])->default('active');
//     $blueprint->string('profile_image')->nullable();
//     $blueprint->rememberToken();
//     $blueprint->timestamps();
// });

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
    $blueprint->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
    $blueprint->string('course_name');
    $blueprint->string('course_code')->unique();
    $blueprint->unsignedDecimal('units', 4, 1)->default(3.0);
    $blueprint->string('level')->nullable();
    $blueprint->enum('semester', ['First', 'Second', 'Third'])->nullable();
    $blueprint->text('description')->nullable();
    $blueprint->enum('status', ['active', 'archived'])->default('active');
    $blueprint->timestamps();
});

// 4. Fees Table
Schema::create('fees', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
    $blueprint->string('title'); // e.g., "Tuition Fee 2024"
    $blueprint->string('category')->nullable();
    $blueprint->decimal('amount', 10, 2);
    $blueprint->string('session'); // e.g., "2023/2024"
    $blueprint->string('semester')->nullable();
    $blueprint->string('level')->nullable();
    $blueprint->enum('status', ['active', 'inactive'])->default('active');
    $blueprint->timestamps();
});

// 5. Payments Table (Student Payment History)
Schema::create('payments', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('fee_id')->constrained();
    $blueprint->string('reference_no')->unique();
    $blueprint->decimal('amount_paid', 10, 2);
    $blueprint->string('session');
    $blueprint->string('semester')->nullable();
    $blueprint->date('payment_date')->nullable();
    $blueprint->enum('status', ['pending', 'completed', 'failed'])->default('completed');
    $blueprint->timestamps();
});

// 6. Registrations Table (Course Registration)
Schema::create('registrations', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->string('semester')->nullable(); // e.g., "First", "Second"
    $blueprint->string('session')->nullable();
    $blueprint->string('level')->nullable();
    $blueprint->enum('status', ['pending', 'approved', 'declined'])->default('pending');
    $blueprint->timestamps();
});
https://images.unsplash.com/photo-1776248783518-400b6d0da64c?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D
// 7. Results Table (Transcripts & Grades)
Schema::create('results', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->decimal('score', 5, 2);
    $blueprint->string('grade', 2);
    $blueprint->decimal('grade_point', 3, 2)->nullable();
    $blueprint->string('remark')->nullable();
    $blueprint->string('semester')->nullable();
    $blueprint->string('session')->nullable();
    $blueprint->string('level')->nullable();
    $blueprint->boolean('is_approved')->default(false); // Management approval
    $blueprint->boolean('is_published')->default(false); // Visible to Student
    $blueprint->timestamps();
});

// 8. Assignments Table
Schema::create('assignments', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
    $blueprint->string('title');
    $blueprint->text('description')->nullable();
    $blueprint->date('due_date')->nullable();
    $blueprint->enum('status', ['pending', 'graded', 'closed'])->default('pending');
    $blueprint->timestamps();
});

// 9. Lecture Materials Table
Schema::create('lecture_materials', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
    $blueprint->string('title');
    $blueprint->text('description')->nullable();
    $blueprint->string('file_url')->nullable();
    $blueprint->timestamps();
});

// 10. Attendance Records Table
Schema::create('attendances', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->date('attendance_date');
    $blueprint->enum('status', ['present', 'absent', 'late'])->default('present');
    $blueprint->string('session')->nullable();
    $blueprint->string('semester')->nullable();
    $blueprint->text('remarks')->nullable();
    $blueprint->timestamps();
});

// 11. Course Schedule Table
Schema::create('course_schedules', function (Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->foreignId('course_id')->constrained();
    $blueprint->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
    $blueprint->enum('day_of_week', ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])->nullable();
    $blueprint->time('start_time')->nullable();
    $blueprint->time('end_time')->nullable();
    $blueprint->string('room')->nullable();
    $blueprint->string('session')->nullable();
    $blueprint->string('semester')->nullable();
    $blueprint->string('level')->nullable();
    $blueprint->enum('status', ['scheduled', 'cancelled', 'completed'])->default('scheduled');
    $blueprint->timestamps();
});

/*
|--------------------------------------------------------------------------
| MODEL FACTORIES (MOCK DATA GENERATION)
|--------------------------------------------------------------------------
*/

// User Factory
// $userFactory = [
//     'name' => fake()->name(),
//     'email' => fake()->unique()->safeEmail(),
//     'password' => bcrypt('password'),
//     'role' => fake()->randomElement(['management', 'teacher', 'student']),
//     'username' => function (array $attributes) {
//         return $attributes['role'] === 'student'
//             ? 'CS-' . date('Y') . '-' . fake()->numerify('####')
//             : fake()->userName();
//     },
//     'matric_number' => function (array $attributes) {
//         return $attributes['role'] === 'student'
//             ? 'CS-' . date('Y') . '-' . fake()->numerify('####')
//             : null;
//     },
//     'biometric_enabled' => fake()->boolean(20),
//     'biometric_token' => function (array $attributes) {
//         return $attributes['biometric_enabled'] ? (string) Str::uuid() : null;
//     },
//     'status' => fake()->randomElement(['active', 'inactive']),
// ];

// Student Profile Factory
// $studentProfileFactory = [
//     'user_id' => null,
//     'legal_name' => fake()->name(),
//     'date_of_birth' => fake()->date(),
//     'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
//     'nationality' => fake()->country(),
//     'state_of_origin' => fake()->state(),
//     'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
//     'phone' => fake()->phoneNumber(),
//     'address' => fake()->address(),
//     'department_id' => null,
//     'faculty' => fake()->word(),
//     'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
//     'enrollment_date' => fake()->date(),
//     'admission_year' => (string) fake()->year(),
//     'current_gpa' => fake()->randomFloat(2, 1.00, 5.00),
//     'profile_image' => null,
//     'qr_code' => null,
// ];

// Teacher Profile Factory
// $teacherProfileFactory = [
//     'user_id' => null,
//     'legal_name' => fake()->name(),
//     'date_of_birth' => fake()->date(),
//     'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
//     'nationality' => fake()->country(),
//     'state_of_origin' => fake()->state(),
//     'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
//     'phone' => fake()->phoneNumber(),
//     'address' => fake()->address(),
//     'department_id' => null,
//     'faculty' => fake()->word(),
//     'designation' => fake()->jobTitle(),
//     'employment_date' => fake()->date(),
//     'profile_image' => null,
// ];

// Management Profile Factory
// $managementProfileFactory = [
//     'user_id' => null,
//     'legal_name' => fake()->name(),
//     'phone' => fake()->phoneNumber(),
//     'address' => fake()->address(),
//     'designation' => fake()->jobTitle(),
//     'profile_image' => null,
// ];

// Department Factory
// $departmentFactory = [
//     'name' => fake()->company() . ' Department',
//     'code' => strtoupper(Str::random(3)),
// ];

// Course Factory
// $courseFactory = [
//     'department_id' => null,
//     'teacher_id' => null,
//     'course_name' => fake()->sentence(3),
//     'course_code' => strtoupper(fake()->bothify('???###')),
//     'units' => fake()->numberBetween(1, 4),
//     'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
//     'semester' => fake()->randomElement(['First', 'Second', 'Third']),
//     'description' => fake()->paragraph(),
//     'status' => 'active',
// ];

// Fee Factory
// $feeFactory = [
//     'title' => 'Academic Fee ' . fake()->word(),
//     'category' => fake()->word(),
//     'amount' => fake()->randomFloat(2, 5000, 50000),
//     'session' => '2023/2024',
//     'semester' => fake()->randomElement(['First', 'Second']),
//     'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
//     'status' => 'active',
//     'department_id' => null,
// ];

// Payment Factory
// $paymentFactory = [
//     'user_id' => null,
//     'fee_id' => null,
//     'reference_no' => strtoupper(fake()->bothify('PAY-#####')),
//     'amount_paid' => fake()->randomFloat(2, 1000, 50000),
//     'session' => '2023/2024',
//     'semester' => fake()->randomElement(['First', 'Second']),
//     'payment_date' => fake()->date(),
//     'status' => fake()->randomElement(['pending', 'completed', 'failed']),
// ];

// Registration Factory
$registrationFactory = [
    'user_id' => null,
    'course_id' => null,
    'semester' => fake()->randomElement(['First', 'Second', 'Third']),
    'session' => '2023/2024',
    'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
    'status' => fake()->randomElement(['pending', 'approved', 'declined']),
];

// Result Factory
$resultFactory = [
    'user_id' => null,
    'course_id' => null,
    'score' => $score = fake()->numberBetween(30, 95),
    'grade' => $score >= 70 ? 'A' : ($score >= 60 ? 'B' : ($score >= 50 ? 'C' : 'F')),
    'grade_point' => round($score / 20, 2),
    'remark' => fake()->randomElement(['Excellent', 'Good', 'Average', 'Poor']),
    'semester' => fake()->randomElement(['First', 'Second', 'Third']),
    'session' => '2023/2024',
    'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
    'is_approved' => fake()->boolean(80),
    'is_published' => fake()->boolean(80),
];

// Assignment Factory
// $assignmentFactory = [
//     'course_id' => null, 
//     'teacher_id' => null,
//     'title' => fake()->sentence(4),
//     'description' => fake()->paragraph(),
//     'due_date' => fake()->date(),
//     'status' => fake()->randomElement(['pending', 'graded', 'closed']),
// ];

// Lecture Material Factory
$lectureMaterialFactory = [
    'course_id' => null,
    'teacher_id' => null,
    'title' => fake()->sentence(4),
    'description' => fake()->paragraph(),
    'file_url' => null,
];

// Attendance Factory
// $attendanceFactory = [
//     'user_id' => null,
//     'course_id' => null,
//     'attendance_date' => fake()->date(),
//     'status' => fake()->randomElement(['present', 'absent']),
//     'session' => '2023/2024',
//     'semester' => fake()->randomElement(['First', 'Second']),
//     'remarks' => fake()->sentence(),
// ];

// Course Schedule Factory
$courseScheduleFactory = [
    'course_id' => null,
    'teacher_id' => null,
    'day_of_week' => fake()->randomElement(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']),
    'start_time' => fake()->time(),
    'end_time' => fake()->time(),
    'room' => fake()->bothify('Hall ??'),
    'session' => '2023/2024',
    'semester' => fake()->randomElement(['First', 'Second', 'Third']),
    'level' => fake()->randomElement(['100', '200', '300', '400', '500']),
    'status' => 'scheduled',
];
