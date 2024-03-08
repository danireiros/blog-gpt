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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('image', 260)->nullable();
            $table->string('description', 255);
            $table->string('system_prompt', 255);
            /* $table->enum('type', ['general', 'política', 'tecnología'])->nullable()->default('general'); */
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('subcategory', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
