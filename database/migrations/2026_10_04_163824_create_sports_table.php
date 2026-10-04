<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->integer('idSports')->primary();
            $table->string('nomSport', 45)->nullable();
            $table->string('description', 45)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sports');
    }
};