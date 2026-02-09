<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Hacemos que contact_id pueda ser nulo (porque al principio no conocemos al contacto)
            $table->foreignId('contact_id')->nullable()->change();
            
            // Añadimos campos para guardar temporalmente quién escribe
            $table->string('sender_name')->after('id');
            $table->string('sender_email')->after('sender_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
};
