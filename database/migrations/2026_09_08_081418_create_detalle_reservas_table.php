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
        Schema::create('detalle_reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mesa');
            $table->unsignedBigInteger('id_reserva');
            $table->string('name');
            $table->string('comensales');
            $table->string('service');
            $table->integer('ninos');  
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->time('reservation_out');
            $table->string('state_atention');
            $table->string('state_mesa');
            $table->string('state_asignation');
            $table->string('id_admin')->nullable(); 
            $table->timestamps();

            $table->foreign('id_mesa')->references('id')->on('mesas');
            $table->foreign('id_reserva')->references('id')->on('reservas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_reservas');
    }
};
