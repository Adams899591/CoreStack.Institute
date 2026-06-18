<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Department;
use App\Models\Fee;
use App\Models\ManagementProfile;
use App\Models\Payment;
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
                '100' => ['Introduction to HTML/CSS', 'Internet Fundamentals', 'Web Graphics & Assets', 'Basic Programming Concepts', 'Introduction to UI/UX', 'Digital Literacy', 'Introduction to Networking', 'Web Design Principles', 'Ethics in Technology'],
                '200' => ['JavaScript Basics', 'UI/UX Design for Web', 'Responsive Design Patterns', 'Frontend Frameworks', 'Version Control with Git', 'Web APIs', 'Client-side Scripting', 'CSS Architecture'],
                '300' => ['Backend Patterns with PHP', 'Database Management Systems', 'API Development & Integration', 'Server-side Logic', 'User Authentication Systems', 'Real-time Web with Sockets', 'Software Testing'],
                '400' => ['Advanced Frameworks (Laravel)', 'Fullstack Architecture', 'DevOps for Web', 'Web Performance Optimization', 'Microservices'],
                '500' => ['Web Security & Scalability', 'Final Web Project', 'Serverless Architectures'],
            ],
            'Mobile App Development' => [
                '100' => ['Logic and Algorithms', 'Intro to Mobile Tech', 'Mobile UX Foundations', 'Programming for Mobile', 'Mobile OS Overview', 'Introduction to Data Structures', 'Discrete Mathematics', 'Computational Thinking', 'App Design Fundamentals'],
                '200' => ['Swift & Kotlin Basics', 'Mobile UI Components', 'Mobile Data Storage', 'Version Control for Mobile', 'Java for Android', 'Objective-C Basics', 'Mobile App Testing', 'Cross-platform Logic'],
                '300' => ['API Integration', 'State Management', 'Mobile Backend Services', 'Native Device Features', 'Mobile App Security', 'Cloud Synchronization', 'Performance Profiling'],
                '400' => ['Cross-Platform Dev (Flutter)', 'App Store Deployment', 'Native Bridge Development', 'Advanced UI Animation', 'Offline-first Applications'],
                '500' => ['Mobile Graphics & Games', 'Final App Project'],
            ],
            'Cyber Security' => [
                '100' => ['Computing Ethics', 'Introduction to Networking', 'Security Fundamentals', 'Operating Systems Basics', 'Cyber Law and Policy', 'Threat Landscape', 'Computer Hardware', 'Network Essentials', 'Digital Literacy'],
                '200' => ['Linux Administration', 'Network Protocols', 'Defensive Security', 'Security Architecture', 'PowerShell Scripting', 'Risk Management', 'Identity Management', 'Secure Coding'],
                '300' => ['Cryptography', 'Ethical Hacking Fundamentals', 'Incident Response', 'Network Security', 'Web Application Security', 'Malware Analysis', 'Computer Forensics'],
                '400' => ['Penetration Testing', 'Digital Forensics', 'Cloud Security', 'Governance and Compliance', 'Infrastructure Security'],
                '500' => ['Enterprise Security Strategy', 'Security Audit Thesis', 'Advanced Malware Analysis'],
            ],
            'Data Science' => [
                '100' => ['Calculus & Algebra', 'Introduction to Python', 'Data Literacy', 'Foundations of Statistics', 'Programming for Data', 'Data Ethics', 'Discrete Mathematics', 'Introduction to Databases', 'Critical Thinking'],
                '200' => ['Statistics & Probability', 'Data Structures', 'Exploratory Data Analysis', 'Data Cleaning and Preprocessing', 'Linear Algebra', 'Multivariable Calculus', 'SQL Basics', 'R Programming'],
                '300' => ['Data Visualization', 'SQL for Data Science', 'Feature Engineering', 'Machine Learning Fundamentals', 'Time Series Analysis', 'Optimization Techniques', 'Big Data Intro'],
                '400' => ['Machine Learning Models', 'Big Data Engineering', 'Deep Learning Basics', 'Natural Language Processing', 'MLOps'],
                '500' => ['Predictive Analytics', 'AI Research Paper'],
            ],
            'AI Development' => [
                '100' => ['Discrete Mathematics', 'Programming Logic', 'Philosophy of AI', 'Introduction to Machine Learning', 'Computational Thinking', 'Problem Solving with AI', 'Logic Fundamentals', 'Introductory Python', 'Mathematics for AI'],
                '200' => ['Linear Algebra', 'Algorithms for AI', 'Probabilistic Reasoning', 'Data for AI', 'Calculus for AI', 'Search Algorithms', 'Reinforcement Fundamentals', 'AI Programming'],
                '300' => ['Neural Networks', 'Natural Language Processing', 'Knowledge Representation', 'Computer Vision Fundamentals', 'Robotic Systems', 'Genetic Algorithms', 'Fuzzy Logic'],
                '400' => ['Deep Learning Frameworks', 'Computer Vision', 'AI in Healthcare', 'Speech Recognition', 'AI Ethics'],
                '500' => ['Reinforcement Learning', 'AI Ethics & Capstone', 'AI Research Methods'],
            ],
        ];

        //1.  Create the 5 specific departments using the factory
        Department::factory(5)->create();
     

        //2.  Create 10 users to e.g teacher management and student to user table
        User::factory(10)->create();

        
        //3.  get all the student
        $students = User::where('role', 'student')->get();
        $baseYear = 2025; // Base year for 100L students (2025/2026)

        // loop through all the students and create profiles with consistent level/admission year logic
        foreach ($students as $student) {
            $level = fake()->randomElement(['100', '200', '300', '400', '500']);
            // Calculate admission year: 100L = base, 200L = base-1, etc.
            $entryYear = $baseYear - (intval($level) / 100 - 1);
            $admissionSession = $entryYear . '/' . ($entryYear + 1);

            StudentProfile::factory()->create([
                'user_id' => $student->id,
                'level' => $level,
                'admission_year' => $admissionSession,
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

                        // Adjust units based on level: 400L and 500L courses get higher units (3, 4, 5)
                        $units = in_array($level, ['400', '500']) 
                            ? fake()->randomElement([3, 4, 5]) 
                            : fake()->numberBetween(2, 4);

                        Course::create([
                            'department_id' => $department->id,
                            'teacher_id' => $teacher->id,
                            'course_name' => $courseName,
                            'course_code' => $courseCode,
                            'units' => $units,
                            'level' => $level,
                            'semester' => fake()->randomElement(['First', 'Second']),
                            'description' => fake()->paragraph(),
                            'status' => 'active',
                        ]);
                    }
                }
            }
        }

        
        // 7. Create unique fees for each department and level
        // This ensures every department and level combination has a specific fee amount
        $levels = ['100', '200', '300', '400', '500'];
        
        foreach ($departments as $department) {
            foreach ($levels as $level) {
                Fee::create([
                    'department_id' => $department->id,
                    'title' => "Academic Tuition Fee - {$department->name}",
                    'category' => 'Tuition',
                    // amount varies randomly between 25k and 85k for each record
                    'amount' => fake()->randomFloat(2, 25000, 85000), 
                    'session' => '2023/2024',
                    'semester' => 'First',
                    'level' => $level,
                    'status' => 'active',
                ]);
            }
        }

        // 8. Generate Payment history for students (Ensures 500L has all previous level fees)
        foreach ($students as $student) {
            $profile = StudentProfile::where('user_id', $student->id)->first();
            if (!$profile) continue;

            $levels = ['100', '200', '300', '400', '500'];
            $currentLevelIndex = array_search($profile->level, $levels);
            
            // Parse the admission session (e.g., "2021/2022") to get the starting year
            $startYear = (int) explode('/', $profile->admission_year)[0];

            // Create a payment for every level leading up to their current level
            for ($i = 0; $i <= $currentLevelIndex; $i++) {
                $targetLevel = $levels[$i];
                $sessionStr = ($startYear + $i) . '/' . ($startYear + $i + 1);

                // Find the specific fee matching department and historical level
                $fee = Fee::where('department_id', $profile->department_id)
                          ->where('level', $targetLevel)
                          ->first();

                if ($fee) {
                    Payment::factory()->create([
                        'user_id' => $student->id,
                        'fee_id' => $fee->id,
                        'amount_paid' => $fee->amount,
                        'session' => $sessionStr,
                        'status' => 'completed',
                        'payment_date' => fake()->dateTimeBetween(
                            ($startYear + $i) . "-01-01", 
                            ($startYear + $i) . "-12-31"
                        ),
                    ]);
                }
            }
        }

        //7. Create 100 student attendence
        Attendance::factory(100)->create();



        

    }
}
