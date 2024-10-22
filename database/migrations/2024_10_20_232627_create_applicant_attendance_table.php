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
        Schema::create('applicant_attendance', function (Blueprint $table) {
            $table->id('attendance_id'); 
            $table->unsignedBigInteger('applicant_id'); 
            $table->enum('attend_orientation', ['Yes', 'No']); 
            $table->string('orientation_date')->nullable();
            $table->string('orientation_proof')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applicant_attendance');
    }
};
