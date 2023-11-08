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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('career')->nullable();
            $table->string('country')->nullable();
            $table->string('type_of_study')->nullable();
            $table->string('area_of_study')->nullable();
            $table->string('institution')->nullable();
            $table->enum('status', ['En Curso', 'Finalizado', 'Abandonado'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->unsignedBigInteger('resume_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
