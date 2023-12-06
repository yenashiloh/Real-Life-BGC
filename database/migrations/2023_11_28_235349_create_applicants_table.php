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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamps();
        });

        Schema::create('applicants_personal_information', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('birthday')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
        });

        Schema::create('applicants_academic_information', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('incoming_grade')->nullable();
            $table->string('current_course_program')->nullable();
            $table->string('current_school')->nullable();
            $table->string('grade_three_gwa')->nullable();
            $table->string('grade_four_gwa')->nullable();
            $table->string('grade_five_gwa')->nullable();
            $table->string('grade_six_gwa')->nullable();
            $table->string('grade_seven_gwa')->nullable();
            $table->string('grade_eight_gwa')->nullable();
            $table->string('grade_nine_gwa')->nullable();
            $table->string('grade_ten_gwa')->nullable();
        });

        Schema::create('applicants_academic_information_colleges', function (Blueprint $table) {
            $table->id('applicant_id');
            $table->string('incoming_year')->nullable();
            $table->string('current_course_program')->nullable();
            $table->string('current_school')->nullable();
            $table->string('grade_nine_gwa')->nullable();
            $table->string('grade_ten_gwa')->nullable();
            $table->string('grade_eleven_first_sem_gwa')->nullable();
            $table->string('grade_eleven_second_sem_gwa')->nullable();
            $table->string('grade_twelve_first_sem_gwa')->nullable();
            $table->string('grade_twelve_second_sem_gwa')->nullable();
            $table->string('first_year_first_sem_gwa')->nullable();
            $table->string('first_year_second_sem_gwa')->nullable();
            $table->string('second_year_first_sem_gwa')->nullable();
            $table->string('second_year_second_sem_gwa')->nullable();
        });

        Schema::create('applicants_academic_information_choice', function (Blueprint $table) {
            $table->id('applicant_id');
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
        Schema::dropIfExists('applicants');
        Schema::dropIfExists('applicants_personal_information');
        Schema::dropIfExists('applicants_academic_information');
        Schema::dropIfExists('applicants_academic_information_college');
        Schema::dropIfExists('applicants_academic_information_choice');
    }
};
