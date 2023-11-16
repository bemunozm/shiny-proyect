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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('corporate_name');
            $table->enum('tax', ['Contribuyente', 'No Contribuyente']);
            $table->unsignedBigInteger('document');
            $table->string('verifier_code', 1);
            $table->string('street_name');
            $table->integer('number');
            $table->string('city');
            $table->bigInteger('phone')->nullable();
            $table->string('industry');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
