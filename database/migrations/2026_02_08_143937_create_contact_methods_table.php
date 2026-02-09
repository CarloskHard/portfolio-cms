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
        Schema::create('contact_methods', function (Blueprint $table) {
            $table->id();
             // Relación con Contacto
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
            
            $table->enum('type', ['email', 'phone', 'linkedin', 'website']);
            $table->string('value'); // El email o teléfono en sí
            $table->string('details')->nullable(); // Ej: "Contactar solo a x horas"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_methods');
    }
};
