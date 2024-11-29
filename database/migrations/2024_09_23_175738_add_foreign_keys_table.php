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
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('cover_id')->references('igdb_id')->on('covers');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
        });

        Schema::table('language_supports', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
            $table->foreign('language_id')->references('igdb_id')->on('languages');
            $table->foreign('language_support_type_id')->references('igdb_id')->on('language_support_types');
        });

        Schema::table('screenshots', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
        });

        Schema::table('websites', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->foreign('platform_family_id')->references('igdb_id')->on('platform_families');
            $table->foreign('platform_logo_id')->references('igdb_id')->on('platform_logos');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('logo_id')->references('igdb_id')->on('company_logos');
        });

        Schema::table('multiplayer_modes', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
            $table->foreign('platform_id')->references('igdb_id')->on('platforms');
        });

        Schema::table('involved_companies', function (Blueprint $table) {
            $table->foreign('company_id')->references('igdb_id')->on('companies');
            $table->foreign('game_id')->references('igdb_id')->on('games');
        });

        Schema::table('release_dates', function (Blueprint $table) {
            $table->foreign('game_id')->references('igdb_id')->on('games');
            $table->foreign('platform_id')->references('igdb_id')->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
};
