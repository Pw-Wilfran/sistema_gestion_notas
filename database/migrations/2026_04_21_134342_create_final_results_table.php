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
        Schema::create('final_results', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('enrollment_id')->unique();

            $table->decimal('final_average', 5, 2);
            $table->string('final_status');
            $table->integer('ranking')->nullable();
            $table->boolean('promoted');

            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_results');
    }
};
