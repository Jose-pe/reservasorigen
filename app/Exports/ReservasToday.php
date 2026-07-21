<?php

namespace App\Exports;

use App\Models\Reserva;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReservasToday implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
         return Reserva::whereDate('reservation_date', Carbon::today()->toDateString())->where('state', '!=', 'Cancelado')->orderBy('reservation_time', 'asc'); 
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Email',
            'Teléfono',
            'Comensales',
            'Fecha',
            'Hora',
            'Servicio',            
            'Detalle Alimentos',            
            'Cant. Niños',
            'Ocasion Especial',
            'Etiqueta',
            'Estado Pago',
            'Estado Reserva',
            'Observación',
            'Usuario Admin',
            
        ];
    }
   
      public function map($reservas): array
    {
        return [
            $reservas->name,
            $reservas->email,
            $reservas->phone,
            $reservas->guests,
            $reservas->reservation_date,
            $reservas->reservation_time,
            $reservas->service,
            //$reservas->food_restrictions,
            $reservas->food_description,
            //$reservas->kids_under_12 ? 'Sí' : 'No', // Convierte booleanos a texto amigable
            $reservas->kids_count ?? 0,
            $reservas->special_time,
            $reservas->label,
            $reservas->pay_state,
            $reservas->state,
            $reservas->observation,
            $reservas->id_admin,
        ];
    }
}
