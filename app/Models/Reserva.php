<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'label',
        'state'

    ];
}
