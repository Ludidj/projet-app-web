<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipe', function (Blueprint $table) {
            $table->id('idEquipe');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->unsignedBigInteger('idSport')->nullable();

            $table->string('nom', 45)->nullable();
            $table->integer('Division')->nullable();

            // Gestion de l'image de l'équipe
            $table->string('image_path')->nullable();

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