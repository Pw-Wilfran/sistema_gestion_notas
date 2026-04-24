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
        Schema::create('report_observations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('teacher_id');

            $table->text('observation');
            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('teacher_id')->references('id')->on('teachers');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_observations');
    }
};
