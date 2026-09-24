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
       Schema::create('libro_reclamaciones', function (Blueprint $table) {
           $table->id();
            $table->string('codigo_correlativo')->unique(); // Ej: LR-2026-00001
            
            // 1. Identificación del Consumidor
            $table->string('tipo_doc');
            $table->string('num_doc');
            $table->string('nombre_completo');
            $table->string('email');
            $table->string('telefono');
            $table->text('direccion');
            $table->boolean('es_menor_edad')->default(false);
            $table->string('nombre_apoderado')->nullable();

            // 2. Bien Contratado
            $table->enum('tipo_bien', ['Producto', 'Servicio']);
            $table->decimal('monto_reclamado', 10, 2);
            $table->text('descripcion_bien');

            // 3. Detalle de Reclamación
            $table->enum('tipo_reclamo', ['Reclamo', 'Queja']);
            $table->text('detalle_reclamo');
            $table->text('pedido_solicitud');
            $table->enum('estado', ['Pendiente', 'Atendido'])->default('Pendiente');
            $table->text('respuesta_proveedor')->nullable();
            $table->timestamp('fecha_respuesta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
};
