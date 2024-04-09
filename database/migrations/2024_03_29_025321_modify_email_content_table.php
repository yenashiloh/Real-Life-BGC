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
        Schema::table('email_content', function (Blueprint $table) {
            // Check if the 'applicant_id' column doesn't exist before adding it
            if (!Schema::hasColumn('email_content', 'applicant_id')) {
                $table->unsignedBigInteger('applicant_id')->nullable()->after('content_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_content', function (Blueprint $table) {
            // Drop the 'applicant_id' column if it exists
            $table->dropColumn('applicant_id');
        });
    }
};
