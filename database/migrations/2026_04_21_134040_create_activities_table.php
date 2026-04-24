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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('academic_assignment_id');
            $table->unsignedBigInteger('period_id');

            $table->string('name');
            $table->string('type')->nullable();
            $table->decimal('percentage', 5, 2);

            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('academic_assignment_id')->references('id')->on('academic_assignments');
            $table->foreign('period_id')->references('id')->on('periods');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
