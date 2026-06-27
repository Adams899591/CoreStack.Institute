<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('semester_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('student_profile_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('payment_id')->constrained()->onDelete('cascade'); // payment table contain session colume and each session colume e.g 2024/2025 on payment table consist of 2 semester 1st and 2nd
            $table->foreignId('result_id')->constrained()->onDelete('cascade'); // Result just helps pass the result id to it
            $table->string("semester"); // seprate the semester by generating result for each 1st and 2nd
            $table->string('session')->nullable();  // 
            $table->string("level");  // which can be either 100, 200, 300, 400, 500,  and must have all result up to the current level on student_profile_id
            $table->decimal('grade_point', 3, 2)->default(0.00); // GP: Based on score (0.00 - 5.00)
            $table->decimal('total_grade_point', 5, 2)->default(0.00); // TGP: CU * GP
            $table->decimal('total_units_registered', 10, 1)->default(0.0); // CCR total
            $table->decimal('total_units_passed', 10, 1)->default(0.0); // CCE total
            $table->decimal('grade_point_average_gpa', 4, 2)->nullable(); // GPA
            $table->decimal('credit_units', 4, 1)->default(0.0); // CU: Snapshot of total course units for this semester
            $table->decimal('total_tgp', 12, 2)->default(0.00); // Running sum of TGPs
            $table->decimal('last_cumulative_cgpa', 4, 2)->nullable(); // LCGPA: snapshot of CGPA before this semester
            $table->decimal('cumulative_cgpa', 4, 2)->nullable(); // CGPA: (last_cumulative_cgpa + semester GPA) / 2
            $table->boolean('senate_approved')->default(true); // Management approval
            $table->boolean('ict_published')->default(true); // Visible to Student only when ict approved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_results');
    }
};
