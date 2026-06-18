<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\Fee;
use App\Models\ManagementProfile;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define the curriculum directly in the seeder for controlled creation
        $curriculum = [
            'Web Development' => [
                '100' => ['Introduction to HTML/CSS', 'Internet Fundamentals', 'Web Graphics & Assets'],
                '200' => ['JavaScript Basics', 'UI/UX Design for Web', 'Responsive Design Patterns'],
                '300' => ['Backend Patterns with PHP', 'Database Management', 'API Development & Integration'],
                '400' => ['Advanced Frameworks (Laravel)', 'Fullstack Architecture', 'DevOps for Web'],
                '500' => ['Web Security & Scalability', 'Final Web Project', 'Serverless Architectures'],
            ],
            'Mobile App Development' => [
                '100' => ['Logic and Algorithms', 'Intro to Mobile Tech', 'Mobile UX Foundations'],
                '200' => ['Swift & Kotlin Basics', 'Mobile UI Components', 'Mobile Data Storage'],
                '300' => ['API Integration', 'State Management', 'Mobile Backend Services'],
                '400' => ['Cross-Platform Dev (Flutter)', 'App Store Deployment', 'Native Bridge Development'],
                '500' => ['Mobile Graphics & Games', 'Final App Project', 'Augmented Reality in Mobile'],
            ],
            'Cyber Security' => [
                '100' => ['Computing Ethics', 'Introduction to Networking', 'Security Fundamentals'],
                '200' => ['Linux Administration', 'Network Protocols', 'Defensive Security'],
                '300' => ['Cryptography', 'Ethical Hacking Fundamentals', 'Incident Response'],
                '400' => ['Penetration Testing', 'Digital Forensics', 'Cloud Security'],
                '500' => ['Enterprise Security Strategy', 'Security Audit Thesis', 'Malware Analysis'],
            ],
            'Data Science' => [
                '100' => ['Calculus & Algebra', 'Introduction to Python', 'Data Literacy'],
                '200' => ['Statistics & Probability', 'Data Structures', 'Exploratory Data Analysis'],
                '300' => ['Data Visualization', 'SQL for Data Science', 'Feature Engineering'],
                '400' => ['Machine Learning Models', 'Big Data Engineering', 'Deep Learning Basics'],
                '500' => ['Predictive Analytics', 'AI Research Paper', 'Ethics in Data Science'],
            ],
            'AI Development' => [
                '100' => ['Discrete Mathematics', 'Programming Logic', 'Philosophy of AI'],
                '200' => ['Linear Algebra', 'Algorithms for AI', 'Probabilistic Reasoning'],
                '300' => ['Neural Networks', 'Natural Language Processing', 'Knowledge Representation'],
                '400' => ['Deep Learning Frameworks', 'Computer Vision'],
                '500' => ['Reinforcement Learning', 'AI Ethics & Capsone'],
            ],
        ];

        //1.  Create the 5 specific departments using the factory
        Department::factory(5)->create();
     

        //2.  Create 10 users to e.g teacher management and student to user table
        User::factory(10)->create();

        
        //3.  get all the student 
        $students = User::where('role', 'student')->get(); 
        // loop througth the all the student on the User table and insect them into the student profile table  
        foreach ($students as $student) {
            StudentProfile::factory()->create([
                'user_id' => $student->id,
            ]);
        }

        //4.  get all the teacher 
        $teachers = User::where('role', 'teacher')->get(); 
        // loop througth the all the teacher on the User table and insect them into the teacher profile table  
        foreach ($teachers as $teacher) {
            TeacherProfile::factory()->create([
                'user_id' => $teacher->id,
            ]);
        }


         //5. get all the management 
        $managements = User::where('role', 'management')->get();
        // loop througth the all the management on the User table and insect them into the management profile table  
        foreach ($managements as $management) {
            ManagementProfile::factory()->create([
                'user_id' => $management->id,
            ]);
        }

        
        //6.  Create courses based on the defined curriculum to ensure uniqueness
        $departments = Department::all();
        $teachers = User::where('role', 'teacher')->get();

        // Ensure there are teachers, otherwise create some
        if ($teachers->isEmpty()) {
            User::factory(5)->teacher()->create();
            $teachers = User::where('role', 'teacher')->get();
        }

        $courseCounter = 1; // Reset counter for course codes

        foreach ($departments as $department) {
            $deptName = $department->name;
            if (isset($curriculum[$deptName])) {
                foreach ($curriculum[$deptName] as $level => $courseNames) {
                    foreach ($courseNames as $courseName) {
                        // Pick a random teacher from the available teachers
                        $teacher = $teachers->random();

                        // Generate a unique course code
                        $prefix = strtoupper(substr(str_replace(' ', '', $deptName), 0, 3));
                        $courseCode = $prefix . '-' . $level . '-' . str_pad($courseCounter++, 2, '0', STR_PAD_LEFT);

                        Course::create([
                            'department_id' => $department->id,
                            'teacher_id' => $teacher->id,
                            'course_name' => $courseName,
                            'course_code' => $courseCode,
                            'units' => fake()->numberBetween(2, 4),
                            'level' => $level,
                            'semester' => fake()->randomElement(['First', 'Second']),
                            'description' => fake()->paragraph(),
                            'status' => 'active',
                        ]);
                    }
                }
            }
        }




        

    }
}
