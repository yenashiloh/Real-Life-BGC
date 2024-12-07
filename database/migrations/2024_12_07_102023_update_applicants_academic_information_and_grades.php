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
        Schema::table('applicants_academic_information', function (Blueprint $table) {
            $table->string('reasonGrades')->after('current_school')->nullable();
        });

        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            $table->dropColumn('reasonGrades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants_academic_information', function (Blueprint $table) {
            $table->dropColumn('reasonGrades');
        });
        
        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            $table->string('reasonGrades')->nullable();
        });
    }
};
