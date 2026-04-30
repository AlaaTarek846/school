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
        Schema::create('school_prides', function (Blueprint $table) {
            $table->id();
            $table->string('card_type'); // left, right
            $table->string('image')->nullable();
            $table->string('overlay_icon')->nullable();
            $table->string('overlay_text_ar')->nullable();
            $table->string('overlay_text_en')->nullable();
            $table->string('icon')->nullable();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_prides');
    }
};
