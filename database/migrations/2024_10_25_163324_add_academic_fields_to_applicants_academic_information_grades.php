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
            $table->string('schoolGrade')->nullable();
            $table->string('yearLevel')->nullable();
            $table->decimal('generalAverage', 5, 2)->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            $table->dropColumn(['schoolGrade', 'yearLevel', 'generalAverage']);
        });
    }
};
