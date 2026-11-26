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
    Schema::table('joueurs', function (Blueprint $table) {
        $table->string('email')->nullable();
        $table->unsignedBigInteger('user_id')->nullable()->unique();

        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('joueurs', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropUnique(['user_id']);
        $table->dropColumn(['email', 'user_id']);
    });
}

};
