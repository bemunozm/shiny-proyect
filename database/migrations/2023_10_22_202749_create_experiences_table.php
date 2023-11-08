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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_activity');
            $table->string('job');
            $table->string('job_area');
            $table->string('job_sub_area');
            $table->string('country');
            $table->date('start_date');
            $table->date('finish_date');
            $table->text('description');
            $table->string('person_in_charge');
            $table->boolean('current')->default(false);
            $table->unsignedBigInteger('resume_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
