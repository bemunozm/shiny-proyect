<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['RUT', 'PASAPORTE']);
            $table->unsignedBigInteger('document');
            $table->string('verifier_code', 1);
            $table->string('name');
            $table->string('last_name');
            $table->bigInteger('phone');
            $table->string('email')->unique();
            $table->string('province')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->enum('gender', ['Masculino', 'Femenino', 'Otro']);
            $table->date('birthdate');
            $table->string('marital_status');
            $table->string('password');
            $table->enum('type', ['Postulante', 'Empresa']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
