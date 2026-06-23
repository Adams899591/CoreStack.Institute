<?php

// =============================================================================
//
//        CORESTACK INSTITUTE — ACADEMIC GRADING CALCULATION EXPLAINED
//        =============================================================================
//        This file is FOR LEARNING ONLY. It is not executed anywhere.
//        It walks you through EVERY STEP of the grading system used in
//        DatabaseSeeder.php, from the very first CA score all the way
//        to the final CGPA stored in the semester_results table.
//
// =============================================================================


// =============================================================================
// SECTION 1: UNDERSTANDING THE SCORE STRUCTURE (How marks are collected)
// =============================================================================
//
//  Every course has a total of 100 marks split into two parts:
//
//  ┌─────────────────────────────────────────────────────────────┐
//  │  CONTINUOUS ASSESSMENT (CA) = 40 marks total               │
//  │    - CA 1  → max 10 marks  (grade_1 column in results)     │
//  │    - CA 2  → max 10 marks  (grade_2 column in results)     │
//  │    - CA 3  → max 10 marks  (grade_3 column in results)     │
//  │    - CA 4  → max 10 marks  (grade_4 column in results)     │
//  │                                                             │
//  │  EXAMINATION (EXAM) = 60 marks                             │
//  │    - Exam  → max 60 marks  (exam_score column in results)  │
//  └─────────────────────────────────────────────────────────────┘
//
//  TOTAL SCORE = CA1 + CA2 + CA3 + CA4 + Exam
//  Maximum possible = 10 + 10 + 10 + 10 + 60 = 100
//
//  EXAMPLE:
//    Student scores on "Introduction to HTML/CSS":
//      CA1 = 8.5,  CA2 = 7.0,  CA3 = 9.0,  CA4 = 6.5,  Exam = 52.0
//      Total Score = 8.5 + 7.0 + 9.0 + 6.5 + 52.0 = 83.0


// =============================================================================
// SECTION 2: CONVERTING TOTAL SCORE TO GRADE & GRADE POINT (GP)
// =============================================================================
//
//  After getting the total score, we check which grade band it falls into.
//  Each grade has a Grade Point (GP) value on a 5.00 scale:
//
//  ┌──────────────────────────────────────────────────┐
//  │  Score Range  │  Grade  │  Grade Point (GP)      │
//  │───────────────│─────────│────────────────────────│
//  │  70 – 100     │   A     │   5.0  (Excellent)     │
//  │  60 – 69      │   B     │   4.0  (Very Good)     │
//  │  50 – 59      │   C     │   3.0  (Good)          │
//  │  45 – 49      │   D     │   2.0  (Pass)          │
//  │  40 – 44      │   E     │   1.0  (Poor Pass)     │
//  │  00 – 39      │   F     │   0.0  (Fail)          │
//  └──────────────────────────────────────────────────┘
//
//  EXAMPLE (continuing from Section 1):
//    Total Score = 83.0  →  falls in 70–100 range  →  Grade = A  →  GP = 5.0
//
//  This GP is what represents the student's quality of performance per course.


// =============================================================================
// SECTION 3: UNDERSTANDING CREDIT UNITS (CU)
// =============================================================================
//
//  Every course carries a CREDIT UNIT (CU) weight.
//  This is defined in the "courses" table (the "units" column).
//  It represents how "heavy" or "important" a course is.
//
//  Examples:
//    - "Introduction to HTML/CSS"   → 3 credit units
//    - "Ethics in Technology"       → 2 credit units
//    - "Advanced Frameworks"        → 4 credit units
//
//  A course with MORE credit units contributes MORE to your GPA.
//  We snapshot this value into the "credit_units" column of semester_results
//  for QUICK READING without needing to join the courses table.


// =============================================================================
// SECTION 4: CALCULATING TOTAL GRADE POINT (TGP) PER COURSE
// =============================================================================
//
//  TGP (Total Grade Point) is calculated per course:
//
//      TGP = Credit Unit (CU)  ×  Grade Point (GP)
//
//  EXAMPLE:
//    "Introduction to HTML/CSS":  CU = 3,  GP = 5.0
//    TGP = 3 × 5.0 = 15.0
//
//  Think of TGP as: "How much quality weight does this course contribute?"
//  A course with more units AND a higher grade contributes the most.
//
//  We accumulate ALL TGPs across all courses in a semester:
//
//      $semesterTgp += $course->units * $gp;
//
//  EXAMPLE SEMESTER (3 courses):
//    Course A: CU=3, GP=5.0  → TGP = 15.0
//    Course B: CU=3, GP=4.0  → TGP = 12.0
//    Course C: CU=2, GP=5.0  → TGP = 10.0
//    ─────────────────────────────────────
//    Semester TGP Sum = 15.0 + 12.0 + 10.0 = 37.0


// =============================================================================
// SECTION 5: TRACKING CREDIT UNITS REGISTERED (CCR) AND EARNED (CCE)
// =============================================================================
//
//  As we loop through each course in the semester, we also track:
//
//  CCR (Credit Units Registered) = total_units_registered
//    → Sum of ALL units for ALL courses taken in the semester
//    → Includes failed courses (F grade)
//    → Stored in: total_units_registered column
//
//  CCE (Credit Units Earned) = total_units_passed
//    → Sum of units for courses where student PASSED (grade is NOT F)
//    → A student earns credit only if they score 40 or above
//    → Stored in: total_units_passed column
//
//  EXAMPLE (continuing):
//    Course A: CU=3, Grade=A  → Registered ✅, Earned ✅
//    Course B: CU=3, Grade=B  → Registered ✅, Earned ✅
//    Course C: CU=2, Grade=A  → Registered ✅, Earned ✅
//    ────────────────────────────────────────────
//    CCR (total_units_registered) = 3 + 3 + 2 = 8
//    CCE (total_units_passed)     = 3 + 3 + 2 = 8  (all passed)
//
//  If a student failed Course B (Grade=F):
//    CCR = 3 + 3 + 2 = 8  (still registered for all)
//    CCE = 3 + 0 + 2 = 5  (only passed A and C)


// =============================================================================
// SECTION 6: CALCULATING SEMESTER GPA
// =============================================================================
//
//  GPA (Grade Point Average) tells us the student's average performance
//  for the ENTIRE SEMESTER, weighted by credit units.
//
//  Formula:
//
//      GPA = Semester TGP Sum ÷ Total Credit Units Registered (CCR)
//
//  This is stored in: grade_point_average_gpa column
//
//  EXAMPLE:
//    Semester TGP Sum = 37.0
//    CCR              = 8
//    GPA = 37.0 ÷ 8  = 4.625  →  rounded to 4.63
//
//  In code:
//      $semesterGpa = $semesterUnitsRegistered > 0
//                       ? ($semesterTgp / $semesterUnitsRegistered)
//                       : 0.0;
//      $semesterGpa = round($semesterGpa, 2);
//
//  The check `$semesterUnitsRegistered > 0` protects against dividing by zero
//  in case a student somehow has no courses.


// =============================================================================
// SECTION 7: RUNNING TOTAL TGP (Across ALL Semesters)
// =============================================================================
//
//  We also keep a running sum of ALL TGPs since the student's first semester.
//  This is stored in: total_tgp column
//
//  After each semester we add that semester's TGP to the running total:
//
//      $runningTgp += $semesterTgp;
//
//  EXAMPLE (student now in 100L Second Semester):
//    100L First Sem TGP  = 37.0
//    100L Second Sem TGP = 28.0
//    Running TGP after 2 semesters = 37.0 + 28.0 = 65.0
//
//  This is stored per semester result row so you can see the cumulative
//  TGP at any point in the student's academic career.


// =============================================================================
// SECTION 8: THE last_cumulative_cgpa COLUMN (Snapshot of Previous CGPA)
// =============================================================================
//
//  BEFORE we calculate the NEW CGPA for the current semester, we first
//  take a SNAPSHOT of what the CGPA was at the END of the PREVIOUS semester.
//
//  This is stored in: last_cumulative_cgpa column
//
//  WHY IS THIS IMPORTANT?
//  It lets you verify any CGPA by looking at a single row in the table.
//  You can always confirm: (last_cumulative_cgpa + semester GPA) / 2 = cumulative_cgpa
//
//  In code:
//      $lastCgpa = $previousCgpa; // save old value BEFORE updating it
//
//  SPECIAL CASE — Very First Semester (100L First Semester):
//    The student has NO previous CGPA yet.
//    So last_cumulative_cgpa = NULL  (meaning "there was nothing before this")
//
//  EXAMPLE TIMELINE:
//    100L 1st Sem → last_cumulative_cgpa = NULL   (first ever semester)
//    100L 2nd Sem → last_cumulative_cgpa = 4.63   (CGPA from 100L 1st Sem)
//    200L 1st Sem → last_cumulative_cgpa = 4.30   (CGPA from 100L 2nd Sem)
//    200L 2nd Sem → last_cumulative_cgpa = 4.47   (CGPA from 200L 1st Sem)


// =============================================================================
// SECTION 9: CALCULATING CUMULATIVE GPA / CGPA
// =============================================================================
//
//  The CGPA (Cumulative GPA) represents the student's overall academic
//  performance from their very FIRST semester up to the CURRENT semester.
//
//  YOUR SCHOOL USES THIS FORMULA:
//
//      New CGPA = (Previous CGPA + Current Semester GPA) / 2
//
//  This is stored in: cumulative_cgpa column
//
//  RULE 1 — First Semester Ever (100L First Semester):
//    There is no previous CGPA, so the CGPA simply equals the semester GPA.
//
//      CGPA = Semester GPA
//
//    Example: Semester GPA = 4.63  →  CGPA = 4.63
//
//  RULE 2 — Every Semester After the First:
//    We average the previous CGPA with the current semester GPA.
//
//      CGPA = (Previous CGPA + Current Semester GPA) / 2
//
//    Example:
//      Previous CGPA (last_cumulative_cgpa) = 4.63
//      Current Semester GPA                 = 4.00
//      New CGPA = (4.63 + 4.00) / 2        = 4.315  →  rounded to 4.32
//
//  In code:
//      $lastCgpa = $previousCgpa;         // step 1: snapshot the old CGPA
//
//      if ($previousCgpa === null) {
//          $cgpa = $semesterGpa;          // step 2a: first semester rule
//      } else {
//          $cgpa = round(($previousCgpa + $semesterGpa) / 2.0, 2); // step 2b
//      }
//
//      $previousCgpa = $cgpa;             // step 3: update for NEXT semester


// =============================================================================
// SECTION 10: COMPLETE WORKED EXAMPLE — Student from 100L to 200L
// =============================================================================
//
//  Student: John Doe | Department: Web Development | Admission: 2025/2026
//
//  ─────────────────────────────────────────────────────────────────────────
//  SEMESTER 1: 100L — First Semester (Session: 2025/2026)
//  ─────────────────────────────────────────────────────────────────────────
//
//  Courses Taken:
//    Course A "Intro to HTML/CSS"   : CU=3, Score=83 → Grade=A, GP=5.0, TGP=15.0
//    Course B "Internet Fundamentals": CU=3, Score=65 → Grade=B, GP=4.0, TGP=12.0
//    Course C "Ethics in Technology" : CU=2, Score=72 → Grade=A, GP=5.0, TGP=10.0
//
//  Calculations:
//    Semester TGP (total_grade_point)     = 15.0 + 12.0 + 10.0 = 37.0
//    CCR (total_units_registered)         = 3 + 3 + 2           = 8
//    CCE (total_units_passed)             = 3 + 3 + 2           = 8  (all passed)
//    credit_units (CU snapshot)           = 8
//    Semester GPA (grade_point_average)   = 37.0 / 8            = 4.63
//    Running TGP (total_tgp)              = 37.0
//    last_cumulative_cgpa                 = NULL  ← first semester ever
//    cumulative_cgpa (CGPA)               = 4.63  ← equals semester GPA (1st time)
//
//  ─────────────────────────────────────────────────────────────────────────
//  SEMESTER 2: 100L — Second Semester (Session: 2025/2026)
//  ─────────────────────────────────────────────────────────────────────────
//
//  Courses Taken:
//    Course D "Web Graphics & Assets"  : CU=3, Score=55 → Grade=C, GP=3.0, TGP=9.0
//    Course E "Basic Programming"      : CU=4, Score=71 → Grade=A, GP=5.0, TGP=20.0
//    Course F "Digital Literacy"       : CU=2, Score=47 → Grade=D, GP=2.0, TGP=4.0
//
//  Calculations:
//    Semester TGP (total_grade_point)     = 9.0 + 20.0 + 4.0   = 33.0
//    CCR (total_units_registered)         = 3 + 4 + 2           = 9
//    CCE (total_units_passed)             = 3 + 4 + 2           = 9  (all passed ≥ 40)
//    credit_units (CU snapshot)           = 9
//    Semester GPA (grade_point_average)   = 33.0 / 9            = 3.67
//    Running TGP (total_tgp)              = 37.0 + 33.0         = 70.0
//    last_cumulative_cgpa                 = 4.63  ← CGPA from 100L 1st Sem
//    cumulative_cgpa (CGPA)               = (4.63 + 3.67) / 2   = 4.15
//
//  ✅ VERIFY: last_cumulative_cgpa(4.63) + semester_GPA(3.67) / 2 = 4.15 ✅
//
//  ─────────────────────────────────────────────────────────────────────────
//  SEMESTER 3: 200L — First Semester (Session: 2026/2027)
//  ─────────────────────────────────────────────────────────────────────────
//
//  Courses Taken:
//    Course G "JavaScript Basics"      : CU=3, Score=78 → Grade=A, GP=5.0, TGP=15.0
//    Course H "Responsive Design"      : CU=3, Score=62 → Grade=B, GP=4.0, TGP=12.0
//
//  Calculations:
//    Semester TGP (total_grade_point)     = 15.0 + 12.0         = 27.0
//    CCR (total_units_registered)         = 3 + 3               = 6
//    CCE (total_units_passed)             = 3 + 3               = 6
//    credit_units (CU snapshot)           = 6
//    Semester GPA (grade_point_average)   = 27.0 / 6            = 4.50
//    Running TGP (total_tgp)              = 70.0 + 27.0         = 97.0
//    last_cumulative_cgpa                 = 4.15  ← CGPA from 100L 2nd Sem
//    cumulative_cgpa (CGPA)               = (4.15 + 4.50) / 2   = 4.33
//
//  ✅ VERIFY: last_cumulative_cgpa(4.15) + semester_GPA(4.50) / 2 = 4.33 ✅


// =============================================================================
// SECTION 11: SUMMARY — ALL COLUMNS IN semester_results AND WHAT THEY HOLD
// =============================================================================
//
//  Column Name               │ What it stores
//  ──────────────────────────│──────────────────────────────────────────────────
//  user_id                   │ The student's ID (from users table)
//  student_profile_id        │ The student's profile ID
//  payment_id                │ The payment record for that session
//  semester                  │ "First" or "Second"
//  session                   │ e.g. "2025/2026"
//  level                     │ "100", "200", "300", "400", or "500"
//  grade_point               │ Same as semester GPA (TGP ÷ CCR)
//  total_grade_point         │ Sum of (CU × GP) for all courses this semester
//  total_units_registered    │ CCR: total credit units student registered for
//  total_units_passed        │ CCE: total credit units student passed (grade ≠ F)
//  grade_point_average_gpa   │ Semester GPA = total_grade_point ÷ total_units_registered
//  credit_units              │ Snapshot of total_units_registered (for quick view)
//  total_tgp                 │ Running sum of ALL TGPs from every semester so far
//  last_cumulative_cgpa      │ The CGPA at the END of the PREVIOUS semester (NULL if first)
//  cumulative_cgpa           │ New CGPA = (last_cumulative_cgpa + semester GPA) / 2
//  is_approved               │ Management has approved this result (true/false)
//  is_published              │ Student can see this result (true/false)
//
// =============================================================================
//  END OF EXPLANATION FILE
// =============================================================================
