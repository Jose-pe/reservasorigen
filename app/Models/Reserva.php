<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Reserva extends Model
{
   
     protected $fillable = [

        'name',
        'email',
        'phone',        
        'guests',
        'reservation_date',
        'reservation_time',
        'service',
        'food_restrictions',
        'food_description',
        'kids_under_12',
        'kids_count',
        'special_time',
        'label',
        'pay_state',
        'state',
        'observation',
        'id_admin',  
        'state_asignation'      
    ];
  
    public function mesas(){
      return $mesa->belongsToMany(Mesa::class);
     }  
}
