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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('academic_assignment_id');

            $table->date('date');
            $table->string('status');
            $table->string('observation')->nullable();

            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('academic_assignment_id')->references('id')->on('academic_assignments');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
