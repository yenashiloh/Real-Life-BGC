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
        Schema::table('applicants_personal_information', function (Blueprint $table) {
            $table->longText('noteAddress')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('applicants_personal_information', function (Blueprint $table) {
            // Revert the column to its original type (adjust as needed)
            $table->string('noteAddress', 255)->change();
        });
    }
};
