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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('fee_id')->constrained();
            $table->string('reference_no')->unique();
            $table->string('paypal_payment_id')->unique();
            $table->string('paypal_transection_id')->unique();
            $table->decimal('amount_paid', 10, 2);
            $table->string('session');
            $table->string('semester')->nullable();
            // $table->date('payment_date')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->string('fee_remitter_url')->unique()->nullable();
            $table->string('fee_breakdown_url')->unique()->nullable();
            $table->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropColumns("payments", ["user_id"]);
        // Schema::dropColumns("payments", ["fee_id"]);
        Schema::dropIfExists('payments');
    }
};
