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
        Schema::create('openai_chat_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('model_name', 255);
            $table->float('temperature')->default(0.8);
            $table->integer('max_tokens')->default(500);
            $table->integer('top_p')->default(1);
            $table->boolean('using')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('openai_chat_models');
    }
};
