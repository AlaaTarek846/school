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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('name', 'name_ar');
            $table->renameColumn('description', 'description_ar');
            $table->renameColumn('job', 'job_ar');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name_ar');
            $table->text('description_en')->nullable()->after('description_ar');
            $table->string('job_en')->nullable()->after('job_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en', 'job_en']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('name_ar', 'name');
            $table->renameColumn('description_ar', 'description');
            $table->renameColumn('job_ar', 'job');
        });
    }
};
