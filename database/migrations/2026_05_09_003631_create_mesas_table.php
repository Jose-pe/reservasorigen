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
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('number');                  // Ejemplo: 'M1', 'T2', 'B3'
            $table->integer('capacity');               // Cantidad máx. de comensales
            $table->enum('shape', ['square', 'round'])->default('square'); // Forma
            $table->enum('zone', ['salon','mezaninne'])->default('salon'); // Área
            $table->enum('status', ['disponible', 'ocupada', 'reservada', 'mantenimiento'])->default('disponible');
            $table->integer('x')->default(100);        // Coordenada X en el plano
            $table->integer('y')->default(100);        // Coordenada Y en el plano
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};
