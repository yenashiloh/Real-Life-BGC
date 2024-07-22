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
        Schema::table('email_content', function (Blueprint $table) {
            $table->boolean('approved')->default(false)->change();
        });
    }

    public function down()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->boolean('approved')->default(null)->change();
        });
    }
};
