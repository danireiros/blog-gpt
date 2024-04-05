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
        Schema::create('web_links', function (Blueprint $table) {
            $table->id();
            $table->string('link', 255);
            $table->foreignId('web_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Usado', 'Pendiente', 'Revisar'])->nullable()->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_links');
    }
};
