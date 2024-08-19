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
        Schema::create('finance_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type')->nullable()->default('expense');
            $table->date('date')->nullable()->default(null);
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('item')->nullable();
            $table->longText('description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_records');
    }
};
