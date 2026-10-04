<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipe', function (Blueprint $table) {
            $table->integer('idEquipe')->primary();
            $table->integer('idSport')->nullable();
            $table->string('nom', 45)->nullable();
            $table->integer('Division')->nullable();

            $table->foreign('idSport')
                ->references('idSports')
                ->on('sports');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipe');
    }
};