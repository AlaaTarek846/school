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
        Schema::table('teams', function (Blueprint $table) {
            // Check if we need to rename 'name' to 'name_ar'
            if (Schema::hasColumn('teams', 'name') && !Schema::hasColumn('teams', 'name_ar')) {
                $table->renameColumn('name', 'name_ar');
            }
            
            // Check if we need to rename 'job' to 'job_ar'
            if (Schema::hasColumn('teams', 'job') && !Schema::hasColumn('teams', 'job_ar')) {
                $table->renameColumn('job', 'job_ar');
            }

            // check if name_en column not exists
            if (!Schema::hasColumn('teams', 'name_en')) {
                 $table->string('name_en')->nullable()->after('updated_at'); // Add at the end or locally
            }

             // check if job_en column not exists
            if (!Schema::hasColumn('teams', 'job_en')) {
                 $table->string('job_en')->nullable()->after('name_en');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
             if (Schema::hasColumn('teams', 'name_ar')) {
                $table->renameColumn('name_ar', 'name');
            }
            if (Schema::hasColumn('teams', 'job_ar')) {
                $table->renameColumn('job_ar', 'job');
            }
            $table->dropColumn(['name_en', 'job_en']);
        });
    }
};
