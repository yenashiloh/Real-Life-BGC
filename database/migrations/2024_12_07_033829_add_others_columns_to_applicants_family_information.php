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
            $table->string('othersOccupation')->nullable()->after('mother_income');
            $table->string('othersRelationship')->nullable()->after('othersOccupation');
            $table->decimal('othersIncome', 10, 2)->nullable()->after('othersRelationship');
        });
    }

    public function down()
    {
        Schema::table('applicants_family_information', function (Blueprint $table) {
            $table->dropColumn(['othersOccupation', 'othersRelationship', 'othersIncome']);
        });
    }
};
