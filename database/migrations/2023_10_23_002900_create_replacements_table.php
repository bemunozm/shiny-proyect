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
        Schema::create('replacements', function (Blueprint $table) {
            $table->id();
            $table->string('job_name');
            $table->string('job_area');
            $table->string('job_sub_area');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->text('job_description');
            $table->unsignedInteger('min_salary');
            $table->unsignedInteger('max_salary');
            $table->unsignedInteger('min_experience');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replacements');
    }
};
