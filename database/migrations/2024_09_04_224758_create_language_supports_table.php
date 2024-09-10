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
        Schema::create('language_supports', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('game')->nullable();
            $table->integer('language')->nullable();
            $table->integer('language_support_type')->nullable();
            $table->timestamps();

            $table->foreign('game')->references('igdb_id')->on('games');
            $table->foreign('language')->references('igdb_id')->on('languages');
            $table->foreign('language_support_type')->references('igdb_id')->on('language_support_types');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_supports');
    }
};
