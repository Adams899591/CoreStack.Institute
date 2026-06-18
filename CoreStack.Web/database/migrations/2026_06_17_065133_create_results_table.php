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
            $table->foreignId('course_id')->constrained();
            $table->decimal('credit_units', 4, 1)->default(0.0); // CU: Snapshot of course units
            $table->decimal('score', 5, 2);
            $table->string('grade', 2);
            $table->decimal('grade_point', 3, 2)->default(0.00); // GP: Based on score (0.00 - 5.00)
            $table->decimal('total_grade_point', 5, 2)->default(0.00); // TGP: CU * GP
            $table->decimal('cumulative_gpa', 4, 2)->nullable(); // CGPA
            $table->decimal('total_tgp', 12, 2)->default(0.00); // Running sum of TGPs
            $table->decimal('total_units_registered', 10, 1)->default(0.0); // CCR total
            $table->decimal('total_units_passed', 10, 1)->default(0.0); // CCE total
            $table->string('semester')->nullable();
            $table->string('session')->nullable();
            $table->string('level')->nullable();
            $table->boolean('is_approved')->default(false); // Management approval
            $table->boolean('is_published')->default(false); // Visible to Student
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
