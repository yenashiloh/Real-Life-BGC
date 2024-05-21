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
        $table->decimal('latestAverage', 8, 2)->nullable()->after('applicant_id');
        $table->decimal('latestGWA', 8, 2)->nullable()->after('latestAverage');
        $table->string('scopeGWA')->nullable()->after('latestGWA');
        $table->decimal('equivalentGrade', 8, 2)->nullable()->after('scopeGWA');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants_academic_information_grades', function (Blueprint $table) {
            //
        });
    }
};
