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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('nationality', 60)->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('nationality');
            $table->string('address')->nullable()->after('date_of_birth');
            $table->string('education_level', 60)->nullable()->after('address');
            $table->string('institution')->nullable()->after('education_level');
            $table->string('graduation_year', 10)->nullable()->after('institution');
            $table->string('gpa', 10)->nullable()->after('graduation_year');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone','nationality','date_of_birth','address','education_level','institution','graduation_year','gpa']);
        });
    }
};
