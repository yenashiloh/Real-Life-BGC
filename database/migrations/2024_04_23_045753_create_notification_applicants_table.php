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
        Schema::dropIfExists('notification_applicants');

        Schema::create('notification_applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('admin_name');
            $table->bigInteger('applicant_id')->unsigned();
            $table->text('message');
            $table->string('status', 255)->default('unread');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_applicants');
    }
};
