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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // Relación con Cliente (Si se borra el cliente, se borran sus contactos)
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('position')->nullable(); // Cargo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
