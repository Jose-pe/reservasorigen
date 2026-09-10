<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReservas extends Model
{
     protected $fillable = [

            'id_mesa',
            'id_reserva',  
            'name',
            'comensales',
            'service',
            'ninos',          
            'reservation_date',
            'reservation_time',
            'reservation_out',
            'state_atention',
            'state_mesa',
            'state_asignation',
            'id_admin',
       ];

      public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa', 'id');
    }

     public function reserva(){
      return $this->belongsTo(Reserva::class, 'id_reserva','id');
     }  
}
