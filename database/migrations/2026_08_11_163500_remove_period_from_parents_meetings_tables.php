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
            if (Schema::hasColumn('parents_meetings', 'period')) {
                $table->dropColumn('period');
            }
        });

        Schema::table('parents_meeting_details', function (Blueprint $table) {
            if (Schema::hasColumn('parents_meeting_details', 'period')) {
                $table->dropColumn('period');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parents_meetings', function (Blueprint $table) {
            if (!Schema::hasColumn('parents_meetings', 'period')) {
                $table->string('period', 10)->nullable()->after('time_to');
            }
        });

        Schema::table('parents_meeting_details', function (Blueprint $table) {
            if (!Schema::hasColumn('parents_meeting_details', 'period')) {
                $table->string('period', 10)->nullable()->after('time_to');
            }
        });
    }
};
