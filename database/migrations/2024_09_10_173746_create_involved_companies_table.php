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
        Schema::create('involved_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('company_id')->nullable();
            $table->boolean('developer')->nullable();
            $table->integer('game_id')->nullable();
            $table->boolean('porting')->nullable();
            $table->boolean('publisher')->nullable();
            $table->boolean('supporting')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('involved_companies');
    }
};
