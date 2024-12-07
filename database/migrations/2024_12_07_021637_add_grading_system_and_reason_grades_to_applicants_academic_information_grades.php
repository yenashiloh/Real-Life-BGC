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
            $table->string('GradingSystem')->nullable()->after('generalAverage');
            $table->text('reasonGrades')->nullable()->after('GradingSystem');
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
            $table->dropColumn(['GradingSystem', 'reasonGrades']);
        });
    }
};
