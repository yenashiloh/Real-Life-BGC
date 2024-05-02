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
            $table->longText('decline')->nullable()->after('house_visitation');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('email_content', function (Blueprint $table) {
            $table->dropColumn('decline');
        });
    }

};
