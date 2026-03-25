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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('password');
            $table->bigInteger('code')->unique();
            $table->string('email')->nullable();
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('country')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('birth_day')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
