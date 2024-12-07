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
        Schema::table('applicants_family_information', function (Blueprint $table) {
            $table->longText('additionalInfo')->nullable()->after('othersIncome');
            $table->dropColumn('total_support_received');
        });
    }

    public function down()
    {
        Schema::table('applicants_family_information', function (Blueprint $table) {
            $table->dropColumn('additionalInfo');
            $table->decimal('total_support_received', 10, 2)->nullable();
        });
    }
};
