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
        Schema::create('webs', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('image', 255)->nullable();
            $table->string('domain', 255);
            $table->string('news_subdomain', 255);
            $table->string('news_container_content_start', 255);
            $table->string('news_container_content_end', 255);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('news_content_start', 255);
            $table->string('news_content_end', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webs');
    }
};
