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
        Schema::table('parents_meetings', function (Blueprint $table) {
            if (!Schema::hasColumn('parents_meetings', 'is_general_time')) {
                $table->boolean('is_general_time')->default(false)->after('note_en');
            }
            if (!Schema::hasColumn('parents_meetings', 'time_from')) {
                $table->time('time_from')->nullable()->after('is_general_time');
            }
            if (!Schema::hasColumn('parents_meetings', 'time_to')) {
                $table->time('time_to')->nullable()->after('time_from');
            }
        });

        Schema::table('parents_meeting_details', function (Blueprint $table) {
            if (Schema::hasColumn('parents_meeting_details', 'time')) {
                $table->dropColumn('time');
            }
            if (!Schema::hasColumn('parents_meeting_details', 'time_from')) {
                $table->time('time_from')->nullable()->after('education_stage_id');
            }
            if (!Schema::hasColumn('parents_meeting_details', 'time_to')) {
                $table->time('time_to')->nullable()->after('time_from');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
