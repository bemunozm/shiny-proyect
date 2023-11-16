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
        Schema::create('language_resume', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');  //FOREING KEY TABLA ROL
            $table->unsignedBigInteger('resume_id');  //FOREING KEY TABLA USER
            $table->enum('written_level', ['Basico', 'Intermedio', 'Avanzado', 'Nativo']);
            $table->enum('oral_level', ['Basico', 'Intermedio', 'Avanzado', 'Nativo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_resume');
    }
};
