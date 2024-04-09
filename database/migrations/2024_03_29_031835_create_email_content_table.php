<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_content', function (Blueprint $table) {
            $table->increments('content_id');
            $table->longText('under_review')->nullable();
            $table->longText('shortlisted')->nullable();
            $table->longText('interview')->nullable();
            $table->longText('house_visitation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_content');
    }
}
