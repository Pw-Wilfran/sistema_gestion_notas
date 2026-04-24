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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('school_grade_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->string('status')->nullable();
            $table->date('enrollment_date');
            $table->boolean('active')->default(true);

            $table->unique(['student_id', 'academic_year_id']);

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('school_grade_id')->references('id')->on('school_grades');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
