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
        Schema::table('requirements', function (Blueprint $table) {
            $table->string('gdrive_file_id')->nullable()->after('uploaded_document');
        });

        Schema::table('applicants_personal_information', function (Blueprint $table) {
            $table->string('gdrive_map_address_id')->nullable()->after('mapAddress');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropColumn('gdrive_file_id');
        });

        Schema::table('applicants_personal_information', function (Blueprint $table) {
            $table->dropColumn('gdrive_map_address_id');
        });
    }
};
