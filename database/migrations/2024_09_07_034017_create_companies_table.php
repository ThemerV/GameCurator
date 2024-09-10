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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('igdb_id')->unique();
            $table->uuid('checksum')->nullable();
            $table->integer('country')->nullable();
            $table->text('description')->nullable();
            $table->json('developed')->nullable();
            $table->integer('logo')->nullable();
            $table->string('name')->nullable();
            $table->integer('parent')->nullable();
            $table->json('published')->nullable();
            $table->string('slug')->unique();
            $table->string('url')->nullable();
            $table->json('websites')->nullable();
            $table->timestamps();

            $table->foreign('logo')->references('igdb_id')->on('company_logos');
            $table->foreign('parent')->references('igdb_id')->on('companies');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
