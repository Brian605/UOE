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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('comment')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('isReply')->default(false);
            $table->bigInteger('userId')->nullable();
            $table->string('userName')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('postId')->nullable();
            $table->bigInteger('parentId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
