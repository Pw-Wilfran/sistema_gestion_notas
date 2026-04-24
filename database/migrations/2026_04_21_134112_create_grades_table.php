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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('enrollment_id');
            $table->unsignedBigInteger('activity_id');

            $table->decimal('value', 5, 2);
            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('activity_id')->references('id')->on('activities');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
