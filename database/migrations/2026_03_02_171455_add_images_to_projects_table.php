<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('projects', 'images')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            // Añadimos la columna JSON para las múltiples imágenes
            $table->json('images')->nullable()->after('description');
        });
    }

    public function down()
    {
        if (! Schema::hasColumn('projects', 'images')) {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
