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
            $table->integer('platform_family_id')->nullable();
            $table->integer('platform_logo_id')->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('url')->nullable();
            $table->json('websites_array')->nullable();
            $table->timestamps();
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
