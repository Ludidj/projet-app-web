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
    Schema::table('match', function (Blueprint $table) {
        $table->string('statut')->default('a_venir');
    });
}

public function down(): void
{
    Schema::table('match', function (Blueprint $table) {
        $table->dropColumn('statut');
    });
}
};
