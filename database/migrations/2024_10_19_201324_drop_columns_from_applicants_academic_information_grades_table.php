<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            $table->dropColumn([
                'grade_3_gwa',
                'grade_4_gwa',
                'grade_5_gwa',
                'grade_6_gwa',
                'grade_7_gwa',
                'grade_8_gwa',
                'grade_9_gwa',
                'grade_10_gwa',
                'grade_11_sem1_gwa',
                'grade_11_sem2_gwa',
                'grade_11_sem3_gwa',
                'grade_11_sem4_gwa',
                'grade_12_sem1_gwa',
                'grade_12_sem2_gwa',
                'grade_12_sem3_gwa',
                'grade_12_sem4_gwa',
                '1st_year_sem1_gwa',
                '1st_year_sem2_gwa',
                '1st_year_sem3_gwa',
                '1st_year_sem4_gwa',
                '2nd_year_sem1_gwa',
                '2nd_year_sem2_gwa',
                '2nd_year_sem3_gwa',
                '2nd_year_sem4_gwa',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            $table->decimal('grade_3_gwa', 5, 2)->nullable();
            $table->decimal('grade_4_gwa', 5, 2)->nullable();
            $table->decimal('grade_5_gwa', 5, 2)->nullable();
            $table->decimal('grade_6_gwa', 5, 2)->nullable();
            $table->decimal('grade_7_gwa', 5, 2)->nullable();
            $table->decimal('grade_8_gwa', 5, 2)->nullable();
            $table->decimal('grade_9_gwa', 5, 2)->nullable();
            $table->decimal('grade_10_gwa', 5, 2)->nullable();
            $table->decimal('grade_11_sem1_gwa', 5, 2)->nullable();
            $table->decimal('grade_11_sem2_gwa', 5, 2)->nullable();
            $table->decimal('grade_11_sem3_gwa', 5, 2)->nullable();
            $table->decimal('grade_11_sem4_gwa', 5, 2)->nullable();
            $table->decimal('grade_12_sem1_gwa', 5, 2)->nullable();
            $table->decimal('grade_12_sem2_gwa', 5, 2)->nullable();
            $table->decimal('grade_12_sem3_gwa', 5, 2)->nullable();
            $table->decimal('grade_12_sem4_gwa', 5, 2)->nullable();
            $table->decimal('1st_year_sem1_gwa', 5, 2)->nullable();
            $table->decimal('1st_year_sem2_gwa', 5, 2)->nullable();
            $table->decimal('1st_year_sem3_gwa', 5, 2)->nullable();
            $table->decimal('1st_year_sem4_gwa', 5, 2)->nullable();
            $table->decimal('2nd_year_sem1_gwa', 5, 2)->nullable();
            $table->decimal('2nd_year_sem2_gwa', 5, 2)->nullable();
            $table->decimal('2nd_year_sem3_gwa', 5, 2)->nullable();
            $table->decimal('2nd_year_sem4_gwa', 5, 2)->nullable();
        });
    }
};
