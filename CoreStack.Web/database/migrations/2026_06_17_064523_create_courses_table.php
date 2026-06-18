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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained("departments")->nullOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('course_name');
            $table->string('course_code')->unique();
            $table->decimal('units', 4, 1)->unsigned()->default(3.0);
            $table->string('level')->nullable();
            $table->enum('semester', ['First', 'Second', 'Third'])->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropColumns("courses", ["department_id"]);
        // Schema::dropColumns("courses", ["teacher_id"]);

        Schema::dropIfExists('courses');
    }
};
