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
        Schema::create('periods', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('academic_year_id');
            $table->string('name');
            $table->integer('number');
            $table->decimal('percentage', 5, 2);

            $table->date('start_date');
            $table->date('end_date');

            $table->string('status')->nullable();
            $table->boolean('active')->default(true);

            $table->foreign('academic_year_id')->references('id')->on('academic_years');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
