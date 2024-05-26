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
        Schema::create('entereds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->ipAddress('ip')->nullable(false);
            $table->string('Country')->nullable(false);
            $table->string('CountryCode')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entereds');
    }
};
