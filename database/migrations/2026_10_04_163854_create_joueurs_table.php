<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->integer('idJoueurs')->primary();
            $table->integer('idEquipe')->nullable();
            $table->string('nom', 45)->nullable();
            $table->string('prénom', 45)->nullable();
            $table->integer('numero')->nullable();
            $table->integer('division')->nullable();
            $table->integer('age')->nullable();
            $table->string('sexe', 45)->nullable();

            $table->foreign('idEquipe')
                ->references('idEquipe')
                ->on('equipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};