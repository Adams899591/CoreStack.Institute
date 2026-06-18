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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('course_id')->constrained();
            $table->string('semester')->nullable(); // e.g., "First", "Second"
            $table->string('session')->nullable();
            $table->string('level')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropColumns("registrations", ["user_id"]);
        // Schema::dropColumns("registrations", ["course_id"]);
        Schema::dropIfExists('registrations');
    }
};
