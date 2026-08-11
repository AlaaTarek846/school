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
        Schema::create('parents_meeting_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parents_meeting_id')->constrained('parents_meetings')->onDelete('cascade');
            $table->foreignId('education_stage_id')->constrained('education_stages')->onDelete('cascade');
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->json('days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents_meeting_details');
    }
};
