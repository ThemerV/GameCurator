<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('collection_game', function (Blueprint $table) {
            $table->integer('game_igdb_id');
            $table->integer('collection_igdb_id');
            $table->foreign('collection_igdb_id')->references('igdb_id')->on('collections')->onDelete('cascade');
            $table->foreign('game_igdb_id')->references('igdb_id')->on('games')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_game');
    }
};
