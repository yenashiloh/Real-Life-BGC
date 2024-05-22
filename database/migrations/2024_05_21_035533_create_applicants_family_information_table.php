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
        Schema::create('applicants_family_information', function (Blueprint $table) {
            $table->id('family_id'); // Change the column name to 'family_id'
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onDelete('cascade');
            $table->integer('total_household_members');
            $table->string('father_occupation')->nullable();
            $table->decimal('father_income', 10, 2)->nullable();
            $table->string('mother_occupation')->nullable();
            $table->decimal('mother_income', 10, 2)->nullable();
            $table->decimal('total_support_received', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants_family_information');
    }
};
