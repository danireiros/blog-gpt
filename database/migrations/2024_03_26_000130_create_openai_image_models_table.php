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
        Schema::create('openai_image_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('model_name', 255);
            $table->string('size', 50);
            $table->boolean('using')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('openai_image_models');
    }
};
