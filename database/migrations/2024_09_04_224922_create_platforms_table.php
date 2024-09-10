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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();

            $table->string('abbreviation')->nullable();
            $table->integer('category')->nullable();
            $table->uuid('checksum')->nullable();
            $table->integer('generation')->nullable();
            $table->string('name')->nullable();
            $table->integer('platform_family')->nullable();
            $table->integer('platform_logo')->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('url')->nullable();
            $table->json('websites')->nullable();
            $table->timestamps();

            $table->foreign('platform_family')->references('igdb_id')->on('platform_families');
            $table->foreign('platform_logo')->references('igdb_id')->on('platform_logos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
