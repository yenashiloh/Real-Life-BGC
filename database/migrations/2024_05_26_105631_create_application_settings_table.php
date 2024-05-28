<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->time('start_time');
            $table->integer('max_number');
            $table->string('current_status');
            $table->date('stop_date');
            $table->time('stop_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_settings');
    }
}
