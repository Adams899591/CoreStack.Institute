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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('legal_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed'])->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            // $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('faculty')->nullable();
            $table->string('level')->nullable();
            $table->date('enrollment_date')->nullable();
            $table->string('admission_year')->nullable();
            $table->decimal('current_gpa', 4, 2)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('qr_code')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropColumns("student_profiles", ["user_id"]);
        Schema::dropIfExists('student_profiles');
    }
};
