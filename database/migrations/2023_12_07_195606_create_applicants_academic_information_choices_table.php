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
        Schema::create('applicants_academic_information_choices', function (Blueprint $table) {
            $table->id('choice_id');
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onDelete('cascade');
            $table->string('first_choice_school')->nullable();
            $table->string('second_choice_school')->nullable();
            $table->string('third_choice_school')->nullable();
            $table->string('first_choice_course')->nullable();
            $table->string('second_choice_course')->nullable();
            $table->string('third_choice_course')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants_academic_information_choices');
    }
};
