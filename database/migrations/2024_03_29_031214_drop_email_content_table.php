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
        Schema::dropIfExists('email_content');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('email_content', function (Blueprint $table) {
            $table->id('content_id');
            $table->text('under_review');
            $table->boolean('shortlisted')->default(false);
            $table->boolean('interview')->default(false);
            $table->boolean('house_visitation')->default(false);
            $table->boolean('decline')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('applicant_id')->nullable();

            // Add foreign key constraint if needed
            // $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');

            // Indexes
            // $table->index('applicant_id');
        });
    }
};
