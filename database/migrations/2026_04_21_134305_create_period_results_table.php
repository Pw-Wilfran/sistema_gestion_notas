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
        Schema::create('period_results', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('period_id');
            $table->unsignedBigInteger('grade_subject_id');

            $table->decimal('average', 5, 2);
            $table->string('status');

            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('grade_subject_id')->references('id')->on('grade_subject');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_results');
    }
};
