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
        Schema::create('game_localizations', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('cover')->nullable();
            $table->integer('game')->nullable();
            $table->string('name')->nullable();
            $table->integer('region')->nullable();
            $table->timestamps();

            $table->foreign('cover')->references('igdb_id')->on('covers');
            $table->foreign('game')->references('igdb_id')->on('games');
            $table->foreign('region')->references('igdb_id')->on('regions');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_localizations');
    }
};
