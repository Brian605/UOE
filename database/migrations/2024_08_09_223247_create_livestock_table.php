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
        Schema::create('livestock', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('type')->unsigned();
            $table->bigInteger('category')->unsigned();
            $table->bigInteger('breed')->unsigned();
            $table->date('birth_date')->nullable();
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->string('name')->nullable();
            $table->string('health_status')->nullable();
            $table->double('milk_produce')->nullable();
            $table->string('uom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock');
    }
};
