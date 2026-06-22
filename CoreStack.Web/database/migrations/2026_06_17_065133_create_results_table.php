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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('course_id')->constrained(); // Course   Note: get the credit unit using course table
            $table->decimal('grade_1', 5, 1)->nullable();  // First  CA 10\10
            $table->decimal('grade_2', 5, 1)->nullable();  // Second  CA 10\10
            $table->decimal('grade_3', 5, 1)->nullable();  // Third  CA 10\10
            $table->decimal('grade_4', 5, 1)->nullable();  // Forth  CA 10\10
            $table->decimal('exam_score', 5, 2)->nullable();  // Exam Score 70/70
            $table->decimal("total_score", 5, 2)->nullable();  // CA + Exam  100/100
            $table->string("grade")->nullable(); // A, B, C, D, E, F
            $table->string("semester");
            $table->string('session')->nullable();  // 
            $table->string("level"); 
            $table->boolean('approved')->default(false); // Teacher approval
            $table->boolean('pending')->default(false); // Pending to Student
            // $table->decimal('credit_units', 4, 1)->default(0.0); // CU: Snapshot of course units
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
