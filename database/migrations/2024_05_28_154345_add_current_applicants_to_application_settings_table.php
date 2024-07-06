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
        Schema::table('application_settings', function (Blueprint $table) {
            $table->integer('current_applicants')->default(0)->after('stop_time');
        });
    }

    public function down()
    {
        Schema::table('application_settings', function (Blueprint $table) {
            $table->dropColumn('current_applicants');
        });
    }

};
