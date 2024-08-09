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
        Schema::create('farm_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('objective')->nullable();
            $table->longText('layout')->nullable();
            $table->longText('infrastructure')->nullable();
            $table->longText('location')->nullable();
            $table->longText('farm_size')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->longText('polygon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_plans');
    }
};
