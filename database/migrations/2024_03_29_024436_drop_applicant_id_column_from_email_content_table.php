<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropApplicantIdColumnFromEmailContentTable extends Migration
{
    public function up()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->dropColumn('applicant_id');
        });
    }

    public function down()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->integer('applicant_id')->after('content_id');
        });
    }
}

