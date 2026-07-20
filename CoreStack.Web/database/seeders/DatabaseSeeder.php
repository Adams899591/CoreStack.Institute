<?php

namespace Database\Seeders;

use App\Models\AcademicPeriod;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\DegreeClassification;
use App\Models\Department;
use App\Models\Fee;
use App\Models\ManagementProfile;
use App\Models\Payment;
use App\Models\Result;
use App\Models\SemesterResult;
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
        User::factory(500)->create();

        
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

        //7.  create record for degree classification
        DegreeClassification::insert([
            ['name' => 'First Class', 'min_cgpa' => 4.50, 'max_cgpa' => 5.00],
            ['name' => 'Second Class Upper', 'min_cgpa' => 3.50, 'max_cgpa' => 4.49],
            ['name' => 'Second Class Lower', 'min_cgpa' => 2.40, 'max_cgpa' => 3.49],
            ['name' => 'Third Class', 'min_cgpa' => 1.50, 'max_cgpa' => 2.39],
            ['name' => 'Pass', 'min_cgpa' => 1.00, 'max_cgpa' => 1.49],
        ]);
 
       //8.  create facker record for Academic record
        $baseYear = 2020;
            $records = [];
            for ($i = 0; $i < 6; $i++) {

                $startYear = $baseYear + $i;
                $endYear = $startYear + 1;

                $session = "{$startYear}/{$endYear}";

                foreach (['First', 'Second'] as $semester) {

                    $records[] = [
                        'session' => $session,
                        'semester' => $semester,
                        'is_current' => 'false',
                    ];
                }
            }
        // make LAST record current = true
        $records[count($records) - 1]['is_current'] = 'true';
        foreach ($records as $record) {
            AcademicPeriod::create($record);
        }


       // 9
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
                            'category' => fake()->randomElement(['Core',"Core","Core",'Elective']),
                            'semester' => fake()->randomElement(['First', 'Second']),
                            'description' => fake()->paragraph(),
                            'status' => 'active',
                        ]);
                    }
                }
            }
        }

        
        // 8. Create unique fees for each department and level
        //  set sql_safe_updates = 0;
        // Update core_stack_db.payments set status = "pending" where session = "2025/2026";
        // SELECT * FROM core_stack_db.payments ;
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
                    'session' => '2025/2026',
                    'semester' => 'First',
                    'level' => $level,
                    'status' => 'active',
                ]);
            }
        }

        // 8. Generate Payment history, Results, and Semester Results for students
        foreach ($students as $student) {
            $profile = StudentProfile::where('user_id', $student->id)->first();
            if (!$profile) continue;

            $levels = ['100', '200', '300', '400', '500'];
            $currentLevelIndex = array_search($profile->level, $levels);
            
            // Parse the admission session (e.g., "2021/2022") to get the starting year
            $startYear = (int) explode('/', $profile->admission_year)[0];

            $runningTgp = 0.0;
            $runningUnits = 0.0;
            $previousCgpa = null;

            // Create a payment and results for every level leading up to their current level
            for ($i = 0; $i <= $currentLevelIndex; $i++) {
                $targetLevel = $levels[$i];
                $sessionStr = ($startYear + $i) . '/' . ($startYear + $i + 1);

                // Find the specific fee matching department and historical level
                $fee = Fee::where('department_id', $profile->department_id)
                          ->where('level', $targetLevel)
                          ->first();

                $payment = null;
                if ($fee) {
                    $payment = Payment::factory()->create([
                        'user_id' => $student->id,
                        'fee_id' => $fee->id,
                        'amount_paid' => $fee->amount,
                        'session' => $sessionStr,
                        'status' => 'completed',
                    ]);
                } else {
                    // Fallback payment creation if fee is missing
                    $fallbackFee = Fee::first() ?: Fee::create([
                        'department_id' => $profile->department_id,
                        'title' => 'Tuition Fee Fallback',
                        'category' => 'Tuition',
                        'amount' => 50000.00,
                        'session' => $sessionStr,
                        'semester' => 'First',
                        'level' => $targetLevel,
                        'status' => 'active'
                    ]);
                    $payment = Payment::factory()->create([
                        'user_id' => $student->id,
                        'fee_id' => $fallbackFee->id,
                        'amount_paid' => $fallbackFee->amount, 
                        'session' => $sessionStr,
                        'status' => 'completed',
                    ]);
                }

                // Generate results for both semesters (First and Second)
                foreach (['First', 'Second'] as $semesterName) {
                    // Find all courses matching department, target level, and semester
                    $courses = Course::where('department_id', $profile->department_id)
                                     ->where('level', $targetLevel)
                                     ->where('semester', $semesterName)
                                     ->get();

                    // If courses is empty, create fallback courses
                    if ($courses->isEmpty()) {
                        $teachers = User::where('role', 'teacher')->get();
                        if ($teachers->isEmpty()) {
                            $teacherUser = User::factory()->create(['role' => 'teacher']);
                            TeacherProfile::factory()->create(['user_id' => $teacherUser->id]);
                            $teachers = collect([$teacherUser]);
                        }

                        for ($c = 1; $c <= 2; $c++) {
                            $prefix = strtoupper(substr(str_replace(' ', '', Department::find($profile->department_id)?->name ?? 'WED'), 0, 3));
                            $courseCode = $prefix . '-' . $targetLevel . '-FB' . $c;
                            Course::create([
                                'department_id' => $profile->department_id,
                                'teacher_id' => $teachers->random()->id,
                                'course_name' => "Fallback Course {$c} for {$targetLevel}L {$semesterName} Sem",
                                'course_code' => $courseCode,
                                'units' => in_array($targetLevel, ['400', '500']) ? fake()->randomElement([3, 4, 5]) : fake()->numberBetween(2, 4),
                                'level' => $targetLevel,
                                'semester' => $semesterName,
                                'description' => fake()->paragraph(),
                                'status' => 'active',
                            ]);
                        }

                        $courses = Course::where('department_id', $profile->department_id)
                                         ->where('level', $targetLevel)
                                         ->where('semester', $semesterName)
                                         ->get();
                    }

                    $semesterTgp = 0.0;
                    $semesterUnitsRegistered = 0.0;
                    $semesterUnitsPassed = 0.0;

                    foreach ($courses as $course) {
                        $grade1 = fake()->randomFloat(1, 5, 10); // First CA (10 max)
                        $grade2 = fake()->randomFloat(1, 5, 10); // Second CA (10 max)
                        $grade3 = fake()->randomFloat(1, 5, 10); // Third CA (10 max)
                        $grade4 = fake()->randomFloat(1, 5, 10); // Fourth CA (10 max)
                        $examScore = fake()->randomFloat(2, 20, 60); // Exam (60 max, since CA sum is 40)
                        $totalScore = min(100.0, floatval($grade1) + floatval($grade2) + floatval($grade3) + floatval($grade4) + floatval($examScore));

                        $grade = 'F';
                        $gp = 0.0;
                        if ($totalScore >= 70) {
                            $grade = 'A';
                            $gp = 5.0;
                        } elseif ($totalScore >= 60) {
                            $grade = 'B';
                            $gp = 4.0;
                        } elseif ($totalScore >= 50) {
                            $grade = 'C';
                            $gp = 3.0;
                        } elseif ($totalScore >= 45) {
                            $grade = 'D';
                            $gp = 2.0;
                        } elseif ($totalScore >= 40) {
                            $grade = 'E';
                            $gp = 1.0;
                        }

                        // Create Course Result
                        Result::create([
                            'user_id' => $student->id,
                            'course_id' => $course->id,
                            'grade_1' => $grade1,
                            'grade_2' => $grade2,
                            'grade_3' => $grade3,
                            'grade_4' => $grade4,
                            'exam_score' => $examScore,
                            'total_score' => $totalScore,
                            'grade' => $grade,
                            'semester' => $semesterName,
                            'session' => $sessionStr,
                            'level' => $targetLevel,
                            'approved' => true,
                            'pending' => false,
                        ]);

                        $semesterTgp += $course->units * $gp;
                        $semesterUnitsRegistered += $course->units;
                        if ($grade !== 'F') {
                            $semesterUnitsPassed += $course->units;
                        }
                    }

                    $semesterGpa = $semesterUnitsRegistered > 0 ? ($semesterTgp / $semesterUnitsRegistered) : 0.0;
                    $semesterGpa = round($semesterGpa, 2);
                    $runningTgp += $semesterTgp;
                    $runningUnits += $semesterUnitsRegistered;

                    // Snapshot the PREVIOUS cumulative CGPA before we calculate the new one.
                    // This is stored as last_cumulative_cgpa so you can always verify:
                    //   last_cumulative_cgpa + grade_point_average_gpa) / 2 = cumulative_cgpa
                    $lastCgpa = $previousCgpa; // NULL for the very first semester (100L First)

                    // Calculate new CGPA:
                    // - First ever semester: CGPA = semester GPA (no previous to average with)
                    // - Every semester after: CGPA = (previous CGPA + this semester GPA) / 2
                    if ($previousCgpa === null) {
                        $cgpa = $semesterGpa;
                    } else {
                        $cgpa = round(($previousCgpa + $semesterGpa) / 2.0, 2);
                    }
                    $previousCgpa = $cgpa;

                    // Create SemesterResult
                    $lastResultId = Result::where('user_id', $student->id)
                        ->where('session', $sessionStr)
                        ->where('semester', $semesterName)
                        ->latest('id')
                        ->value('id');

                    SemesterResult::create([
                        'user_id' => $student->id,
                        'student_profile_id' => $profile->id,
                        'payment_id' => $payment->id,
                        'result_id' => $lastResultId,
                        'semester' => $semesterName,
                        'session' => $sessionStr,
                        'level' => $targetLevel,
                        'grade_point' => round($semesterGpa, 2),
                        'total_grade_point' => round($semesterTgp, 2),
                        'total_units_registered' => round($semesterUnitsRegistered, 1),
                        'total_units_passed' => round($semesterUnitsPassed, 1),
                        'grade_point_average_gpa' => round($semesterGpa, 2),
                        'credit_units' => round($semesterUnitsRegistered, 1), // CU: Snapshot of total course units pulled directly from courses table
                        'total_tgp' => round($runningTgp, 2),
                        'last_cumulative_cgpa' => $lastCgpa, // Previous CGPA before this semester (NULL for 100L 1st sem)
                        'cumulative_cgpa' => round($cgpa, 2), // (last_cumulative_cgpa + semester GPA) / 2
                        'senate_approved' => true,
                        'ict_published' => true,
                    ]);
                }
            }
        }





        
        //9. Create 100 student attendence
        // Attendance::factory(10)->create();

        // //10. Create 25 assignment record
        // Assignment::factory(25)->create();



        

    }
}
