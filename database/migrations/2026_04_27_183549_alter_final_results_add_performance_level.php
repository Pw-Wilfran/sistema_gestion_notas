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
        Schema::table('final_results', function (Blueprint $table) {
            $table->unsignedBigInteger('performance_level_id')->nullable()->after('id');

            $table->foreign('performance_level_id')->references('id')->on('performance_levels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('final_results', function (Blueprint $table) {
            $table->dropForeign(['performance_level_id']);
            $table->dropColumn(['performance_level_id']);
        });
    }
};
