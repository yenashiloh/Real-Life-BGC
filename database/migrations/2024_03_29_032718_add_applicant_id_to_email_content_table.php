<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApplicantIdToEmailContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->unsignedInteger('applicant_id')->nullable()->after('content_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->dropColumn('applicant_id');
        });
    }
}
