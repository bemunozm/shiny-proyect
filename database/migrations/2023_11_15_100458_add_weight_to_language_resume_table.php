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
        Schema::table('language_resume', function (Blueprint $table) {
            $table->unsignedTinyInteger('weight')->after('oral_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('language_resume', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
};
