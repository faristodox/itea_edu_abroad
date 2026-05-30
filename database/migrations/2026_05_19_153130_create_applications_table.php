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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Program selection
            $table->string('program_name');
            $table->string('destination');
            $table->string('level');
            $table->string('university')->nullable();
            $table->string('intake')->nullable();
            // Personal details
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            // Education details
            $table->string('current_education_level')->nullable();
            $table->string('current_institution')->nullable();
            $table->string('graduation_year', 10)->nullable();
            $table->string('gpa', 10)->nullable();
            $table->text('personal_statement')->nullable();
            // Status
            $table->string('status')->default('draft'); // draft, submitted, reviewing, result
            $table->string('result')->nullable(); // accepted, rejected, conditional
            $table->text('admin_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
