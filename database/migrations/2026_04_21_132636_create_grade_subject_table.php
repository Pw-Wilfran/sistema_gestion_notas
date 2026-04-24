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
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_grade_id');
            $table->unsignedBigInteger('subject_id');

            $table->boolean('active')->default(true);

            $table->foreign('school_grade_id')->references('id')->on('school_grades');
            $table->foreign('subject_id')->references('id')->on('subjects');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_subject');
    }
};
