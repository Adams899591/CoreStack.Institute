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
            $table->decimal('score', 5, 2);
            $table->string('grade', 2);
            $table->decimal('grade_point', 3, 2)->nullable();
            $table->string('remark')->nullable();
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
        // Schema::dropColumns("results", ["user_id"]);
        // Schema::dropColumns("results", ["course_id"]);
        Schema::dropIfExists('results');
    }
};
