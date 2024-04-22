<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropNotificationApplicantsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('notification_applicants');
    }

    public function down()
    {
        // No need to implement the down() method for dropping a table
    }
}

