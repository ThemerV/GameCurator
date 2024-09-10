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
        Schema::create('game_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('game')->nullable();
            $table->string('name')->nullable();
            $table->string('video_id')->nullable();
            $table->timestamps();

            $table->foreign('game')->references('igdb_id')->on('games');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_videos');
    }
};
