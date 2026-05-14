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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 200);
            $table->string('whatsapp', 30)->nullable();
            $table->string('destination', 60)->nullable();
            $table->string('level', 60)->nullable();
            $table->string('intake', 60)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 30)->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
