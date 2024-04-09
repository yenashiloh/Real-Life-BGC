<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEmailContentColumnsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->longText('under_review')->nullable()->change();
            $table->longText('shortlisted')->nullable()->change();
            $table->longText('interview')->nullable()->change();
            $table->longText('house_visitation')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Since we are just changing column types, we won't reverse this operation
    }
}
