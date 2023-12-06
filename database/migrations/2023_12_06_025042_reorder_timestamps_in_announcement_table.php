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
        $timestamps = DB::table('announcement')
        ->orderBy('created_at', 'asc')
        ->pluck('created_at');

    foreach ($timestamps as $index => $timestamp) {
        DB::table('announcement')
            ->where('created_at', $timestamp)
            ->update(['created_at' => now()->addMinutes($index)]); 
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcement', function (Blueprint $table) {
            //
        });
    }
};
