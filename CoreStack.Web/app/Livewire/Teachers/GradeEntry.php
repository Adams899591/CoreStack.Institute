<?php


namespace App\Livewire\Teachers;

use App\Models\AcademicPeriod;
use App\Models\Course;
use App\Models\Result;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GradeEntry extends Component
{
    public $selectedCourseId = null;  // Global Varable that help to hold the course id selected
    public $resultsWithStudents = []; // Store as array for seamless Livewire binding
    public $searchQuery; // this help to hold the varable passed from the search query

    // Rules matching your 10% / 10% / 10% / 10% / 60% layout structure
    protected $rules = [
        "resultsWithStudents.*.grade_1" => ['nullable', 'numeric', 'min:0', 'max:10'],
        "resultsWithStudents.*.grade_2" => ['nullable', 'numeric', 'min:0', 'max:10'],
        "resultsWithStudents.*.grade_3" => ['nullable', 'numeric', 'min:0', 'max:10'],
        "resultsWithStudents.*.grade_4" => ['nullable', 'numeric', 'min:0', 'max:10'],
        "resultsWithStudents.*.exam_score" => ['nullable', 'numeric', 'min:0', 'max:70'],
    ];

    public function mount()
    {
        $this->resultsWithStudents = [];
    }

    // Function that loads the students and results when a course is selected
    public function SelectedCourseId($courseId)
    {
        $this->selectedCourseId = $courseId;
        
        $academicPeriod = AcademicPeriod::where('is_current', 'true')->first();
        
        if (!$academicPeriod || !$courseId) {
            $this->resultsWithStudents = [];
            return;
        }

        // Fetching results and casting to array prevents any hydration/dehydration binding bugs in Livewire
        $this->resultsWithStudents = Result::where("course_id", $courseId)
            ->where('semester', $academicPeriod->semester)
            ->where('session', $academicPeriod->session)
            ->with('user.studentProfile')
            ->get()
            ->toArray();
    }

    // Function to handle searchQuery based on the passed student matric number
    public function searchStudents(){
        // Validate search query is not empty
        if(!$this->searchQuery){
            session()->flash('searchError', 'Please enter a search query!');
            return;
        }

        // Validate course is selected first
        if(!$this->selectedCourseId){
            session()->flash('searchError', 'Please select a course first!');
            return;
        }

        // Find the student by matric number
        $studentProfile = StudentProfile::where("matric_number", $this->searchQuery)->first();

        if (!$studentProfile) {
            session()->flash('searchError', 'Invalid matric number! Student not found.');
            return;
        }

        // Get current academic period
        $academicPeriod = AcademicPeriod::where('is_current', 'true')->first();

        if (!$academicPeriod) {
            session()->flash('searchError', 'No active academic period found!');
            return;
        }

        // Filter results to show only the searched student's result for the selected course
        $this->resultsWithStudents = Result::where("course_id", $this->selectedCourseId)
            ->where('semester', $academicPeriod->semester)
            ->where('session', $academicPeriod->session)
            ->whereHas('user.studentProfile', function ($query) {
                $query->where('matric_number', $this->searchQuery);
            })
            ->with('user.studentProfile')
            ->get()
            ->toArray();

        if (empty($this->resultsWithStudents)) {
            session()->flash('searchError', 'No results found for this student in the selected course.');
            return;
        }

        // this section help me to extract the student name and matric number so it can be used on success message
        $studentResult = $this->resultsWithStudents[0] ?? [];
        $studentName = $studentResult['user']['name'] ?? 'the selected student';
        $matricNumber = $studentResult['user']['student_profile']['matric_number'] ?? 'unknown';

        session()->flash('message', "Showing result of {$studentName} with a matric number of {$matricNumber}.");
    }

    /**
     * Save the grade for a single student row.
     * The $index corresponds to the array key in the $resultsWithStudents array.
     */
    public function saveGrade($index)
    {
        // 1. Validate only the specific index being updated
        $this->validate([
            "resultsWithStudents.{$index}.grade_1" => ['nullable', 'numeric', 'min:0', 'max:10'],
            "resultsWithStudents.{$index}.grade_2" => ['nullable', 'numeric', 'min:0', 'max:10'],
            "resultsWithStudents.{$index}.grade_3" => ['nullable', 'numeric', 'min:0', 'max:10'],
            "resultsWithStudents.{$index}.grade_4" => ['nullable', 'numeric', 'min:0', 'max:10'],
            "resultsWithStudents.{$index}.exam_score" => ['nullable', 'numeric', 'min:0', 'max:60'],
        ]);

        $resultToSave = $this->resultsWithStudents[$index];

        // 2. Calculate the total score safely
        $total = ($resultToSave['grade_1'] ?? 0) +
                 ($resultToSave['grade_2'] ?? 0) +
                 ($resultToSave['grade_3'] ?? 0) +
                 ($resultToSave['grade_4'] ?? 0) +
                 ($resultToSave['exam_score'] ?? 0);

        // 3. Find the record in the database and save updates
        $result = Result::find($resultToSave['id']);
        if ($result) {
            $result->update([
                'grade_1' => $resultToSave['grade_1'] ?: 0,
                'grade_2' => $resultToSave['grade_2'] ?: 0,
                'grade_3' => $resultToSave['grade_3'] ?: 0,
                'grade_4' => $resultToSave['grade_4'] ?: 0,
                'exam_score' => $resultToSave['exam_score'] ?: 0,
                'total_score' => $total,
                'grade' => $this->calculateGrade($total), // helper logic to cal culate student Grade
            ]);
        }

        // 4. Refresh local state with updated database records
        $this->SelectedCourseId($this->selectedCourseId);

        // 5. Show success flash alert
        session()->flash('message', 'Grade saved successfully!');
    }


    //  Helper function to calculate student grade 
    public function calculateGrade($total)
    {
        if ($total >= 70) {
            return 'A';
        } else if ($total >= 60) {
            return 'B';
        } else if ($total >= 50) {
            return 'C';
        } else if ($total >= 45) {
            return 'D';
        } else if ($total >= 40) {
            return 'E';
        } else {
            return 'F';
        }
    }




    public function render()
    { 
        $teacherId = Auth::id(); 
        $academicPeriod = AcademicPeriod::where('is_current', 'true')->first();

        $courses = collect();

        //  Fetch all cources assigned to that particular lectural
        if ($academicPeriod) {
            $courses = Course::where('teacher_id', $teacherId)  
                ->where('semester', $academicPeriod->semester)
                ->where('status', "active")
                ->get();
        }

        return view('livewire.teachers.grade-entry', [ 
            "courses" => $courses, 
            "resultsWithStudents" => $this->resultsWithStudents 
        ])->layout("layouts.teachers.app");
    }
}