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
        Schema::create('applicants_academic_information_grades', function (Blueprint $table) {
            $table->id('grade_id');
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onDelete('cascade');
            $table->string('grade_3_gwa')->nullable();
            $table->string('grade_4_gwa')->nullable();
            $table->string('grade_5_gwa')->nullable();
            $table->string('grade_6_gwa')->nullable();
            $table->string('grade_7_gwa')->nullable();
            $table->string('grade_8_gwa')->nullable();
            $table->string('grade_9_gwa')->nullable();
            $table->string('grade_10_gwa')->nullable();
            $table->string('grade_11_sem1_gwa')->nullable();
            $table->string('grade_11_sem2_gwa')->nullable();
            $table->string('grade_12_sem1_gwa')->nullable();
            $table->string('grade_12_sem2_gwa')->nullable();
            $table->string('1st_year_sem1_gwa')->nullable();
            $table->string('1st_year_sem2_gwa')->nullable();
            $table->string('2nd_year_sem1_gwa')->nullable();
            $table->string('2nd_year_sem2_gwa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants_academic_information_grades');
    }
};
