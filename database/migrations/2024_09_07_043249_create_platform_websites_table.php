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
        Schema::create('platform_websites', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->integer('category')->nullable();
            $table->uuid('checksum')->nullable();
            $table->boolean('trusted')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_websites');
    }
};
