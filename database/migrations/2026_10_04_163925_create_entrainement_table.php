<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrainement', function (Blueprint $table) {
            $table->integer('idEntrainement')->primary();
            $table->integer('idEquipe')->nullable();
            $table->string('heure', 45)->nullable();
            $table->string('fréquence', 45)->nullable();

            $table->foreign('idEquipe')
                ->references('idEquipe')
                ->on('equipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrainement');
    }
};