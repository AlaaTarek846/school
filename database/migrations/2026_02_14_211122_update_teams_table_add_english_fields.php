<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->renameColumn('name', 'name_ar');
            $table->renameColumn('job', 'job_ar');
            $table->string('name_en')->nullable()->after('name');
            $table->string('job_en')->nullable()->after('job');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->renameColumn('name_ar', 'name');
            $table->renameColumn('job_ar', 'job');
            $table->dropColumn(['name_en', 'job_en']);
        });
    }
};
