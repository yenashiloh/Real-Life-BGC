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
            // Drop the columns
            $table->dropColumn(['latestAverage', 'latestGWA', 'scopeGWA', 'equivalentGrade']);
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
            $table->decimal('latestAverage', 8, 2)->nullable();
            $table->decimal('latestGWA', 8, 2)->nullable();
            $table->decimal('scopeGWA', 8, 2)->nullable();
            $table->decimal('equivalentGrade', 8, 2)->nullable();
        });
    }
};
