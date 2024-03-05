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
        Schema::create('author_persons', function (Blueprint $table) {
            $table->id();
            /* $table->string('name', 255); */
            $table->string('username', 255);
            /* $table->string('image', 260)->nullable(); */
            $table->foreignId('author_general_id')->onDelete('cascade');
            $table->enum('choices', ['ad', 'post', 'course', 'movie', 'other'])->nullable()->default('ad');
            $table->string('other', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_persons');
    }
};
