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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Mis columnas personalizadas
            $table->string('title');
            $table->text('description');
            $table->string('image_url')->nullable(); // Puede no tener imagen al principio
            $table->enum('visibility', ['public', 'private', 'draft'])->default('draft');
            $table->string('url_demo')->nullable();
            $table->string('url_repo')->nullable();

            $table->timestamps(); // Crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
