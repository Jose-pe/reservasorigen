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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');

            $table->string('email');

            $table->string('phone')->nullable();

            $table->integer('guests');

            $table->date('reservation_date');

            $table->string('reservation_time');

            $table->string('service');

            $table->boolean('food_restrictions')
                  ->default(false);

            $table->text('food_description')
                  ->nullable();

            $table->boolean('kids_under_12')
                  ->default(false);

            $table->integer('kids_count')
                  ->default(0);

            $table->string('label')->nullable()->default('Reserva web');

            $table->string('state')->default('Pendiente');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
