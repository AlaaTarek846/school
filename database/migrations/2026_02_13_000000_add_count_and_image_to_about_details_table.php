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
        Schema::table('about_details', function (Blueprint $table) {
            $table->string('image')->nullable()->after('title_en');
            $table->integer('count')->default(0)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_details', function (Blueprint $table) {
            $table->dropColumn(['image', 'count']);
        });
    }
};
