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
        Schema::create('rotation_group_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rotation_group_id');
            $table->unsignedBigInteger('grade_subject_id');
            $table->integer('rotation_order')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('rotation_group_id')->references('id')->on('rotation_groups')->onDelete('cascade');
            $table->foreign('grade_subject_id')->references('id')->on('grade_subject')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rotation_group_subjects');
    }
};
