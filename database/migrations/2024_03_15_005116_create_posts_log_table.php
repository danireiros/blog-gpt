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
        Schema::create('posts_log', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 255);
            $table->string('subdomain', 255)->nullable();
            $table->string('posts_found', 255);
            $table->string('posts_generated', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_log');
    }
};
