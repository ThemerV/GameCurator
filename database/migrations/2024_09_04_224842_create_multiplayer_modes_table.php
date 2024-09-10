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
        Schema::create('multiplayer_modes', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->boolean('dropin')->nullable();
            $table->integer('game')->nullable();
            $table->boolean('lancoop')->nullable();
            $table->boolean('offlinecoop')->nullable();
            $table->integer('offlinecoopmax')->nullable();
            $table->integer('offlinemax')->nullable();
            $table->boolean('onlinecoop')->nullable();
            $table->integer('onlinecoopmax')->nullable();
            $table->integer('onlinemax')->nullable();
            $table->integer('platform')->nullable();
            $table->boolean('splitscreen')->nullable();
            $table->boolean('splitscreenonline')->nullable();
            $table->timestamps();

            $table->foreign('game')->references('igdb_id')->on('games');
            $table->foreign('platform')->references('igdb_id')->on('platforms');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiplayer_modes');
    }
};
