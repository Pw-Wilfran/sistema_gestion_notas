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
        Schema::table('academic_assignments', function (Blueprint $table) {
            $table->unsignedBigInteger('rotation_group_id')->nullable()->after('academic_year_id');

            $table->foreign('rotation_group_id')->references('id')->on('rotation_groups')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_assignments', function (Blueprint $table) {
            $table->dropForeign(['rotation_group_id']);
            $table->dropColumn(['rotation_group_id']);
        });
    }
};
