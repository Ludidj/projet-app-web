<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match', function (Blueprint $table) {
            $table->id('idMatch');

            $table->unsignedBigInteger('idEquipe')->nullable();
            $table->date('date')->nullable();
            $table->string('Lieu', 100)->nullable();
            $table->time('heure')->nullable();
            $table->unsignedBigInteger('idAdversaire')->nullable();
            $table->integer('scoreEquipe')->nullable();
            $table->integer('scoreAdversair')->nullable();

            $table->foreign('idEquipe')
                ->references('idEquipe')
                ->on('equipe');

            $table->foreign('idAdversaire')
                ->references('idEquipe')
                ->on('equipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match');
    }
};