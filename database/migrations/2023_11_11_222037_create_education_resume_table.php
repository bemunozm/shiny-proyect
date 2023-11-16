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
        Schema::create('education_resume', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resume_id');  //FOREING KEY TABLA ROL
            $table->unsignedBigInteger('education_id');
            $table->enum('status', ['En Curso', 'Finalizado', 'Abandonado'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_resume');
    }
};
