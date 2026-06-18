<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
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
        //1.  Create the 5 specific departments using the factory
        Department::factory(5)->create();
     


        //2.  Create 10 users to e.g teacher management and student to user table
        User::factory(10)->create();

        
        $students = User::where('role', 'student')->get(); // get all the student 
        // loop througth the all the student on the User table and insect them into the student profile table  
        foreach ($students as $student) {
            StudentProfile::factory()->create([
                'user_id' => $student->id,
            ]);
        }

        $teachers = User::where('role', 'teacher')->get(); // get all the teacher 
        // loop througth the all the teacher on the User table and insect them into the teacher profile table  
        foreach ($teachers as $teacher) {
            TeacherProfile::factory()->create([
                'user_id' => $teacher->id,
            ]);
        }

           Course::factory(50)->create();




        

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
