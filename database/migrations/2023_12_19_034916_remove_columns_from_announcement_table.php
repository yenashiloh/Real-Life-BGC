<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('announcement', function (Blueprint $table) {
            $table->dropColumn([
                'image_two',
                'image_three',
                'image_four',
                'image_five',
                'image_six',
                'image_seven',
                'image_eight',
                'image_nine',
                'image_ten',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcement', function (Blueprint $table) {
        $table->string('image_two')->nullable();
        $table->string('image_three')->nullable();
        $table->string('image_four')->nullable();
        $table->string('image_five')->nullable();
        $table->string('image_six')->nullable();
        $table->string('image_seven')->nullable();
        $table->string('image_eight')->nullable();
        $table->string('image_nine')->nullable();
        $table->string('image_ten')->nullable();
        });
    }
};
