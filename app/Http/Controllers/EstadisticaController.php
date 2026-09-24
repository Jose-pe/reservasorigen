<?php
namespace App\Http\Controllers;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    public function reservas(Request $request)
    {
        $year = $request->get('year', now()->year);

        /*
        |--------------------------------------------------------------------------
        | RESERVAS ATENDIDAS Y CANCELADAS POR MES
        |--------------------------------------------------------------------------
        */

        $reservasPorMes = Reserva::whereYear('reservation_date', $year)
            ->selectRaw("
                MONTH(reservation_date) as mes,

                SUM(
                    CASE
                        WHEN LOWER(state) = 'Atendido'
                        THEN 1
                        ELSE 0
                    END
                ) as atendido,

                SUM(
                    CASE
                        WHEN LOWER(state) = 'Cancelado'
                        THEN 1
                        ELSE 0
                    END
                ) as cancelado
            ")
            ->groupByRaw('MONTH(reservation_date)')
            ->orderBy('mes')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CREAR LOS 12 MESES
        |--------------------------------------------------------------------------
        */

        $meses = [
            1  => 'Enero',
            2  => 'Febrero',
            3  => 'Marzo',
            4  => 'Abril',
            5  => 'Mayo',
            6  => 'Junio',
            7  => 'Julio',
            8  => 'Agosto',
            9  => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];


        /*
        |--------------------------------------------------------------------------
        | GENERAR DATOS PARA EL CHART
        |--------------------------------------------------------------------------
        */

        $estadisticas = [];

        foreach ($meses as $numero => $nombre) {

            $registro = $reservasPorMes->firstWhere('mes', $numero);

            $estadisticas[] = [
                'mes' => $nombre,

                'atendido' => $registro
                    ? (int) $registro->atendido
                    : 0,

                'cancelado' => $registro
                    ? (int) $registro->cancelado
                    : 0,
            ];
        }

  $year = $request->get('year', Carbon::now()->year);

        /*
        |--------------------------------------------------------------------------
        | 1. RESERVAS POR MES
        |--------------------------------------------------------------------------
        */
        
        $reservasPorMes = Reserva::whereYear('reservation_date', $year)
            ->selectRaw('MONTH(reservation_date) as mes, COUNT(*) as total')
            ->groupByRaw('MONTH(reservation_date)')
            ->orderBy('mes')
            ->pluck('total', 'mes');


        $meses = [
            1  => 'Enero',
            2  => 'Febrero',
            3  => 'Marzo',
            4  => 'Abril',
            5  => 'Mayo',
            6  => 'Junio',
            7  => 'Julio',
            8  => 'Agosto',
            9  => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];


        $estadisticasMeses = [];

        foreach ($meses as $numero => $nombre) {

            $estadisticasMeses[] = [
                'mes'   => $nombre,
                'total' => $reservasPorMes->get($numero, 0),
            ];

        }

          $totalReservas = $reservasPorMes->sum();

        $reservasWebPorMes = Reserva::whereYear('reservation_date', $year)
    ->where('label', 'Reserva Web')
    ->selectRaw('MONTH(reservation_date) as mes, COUNT(*) as total')
    ->groupByRaw('MONTH(reservation_date)')
    ->orderBy('mes')
    ->pluck('total', 'mes');


/*
|--------------------------------------------------------------------------
| CREAR LOS 12 MESES
|--------------------------------------------------------------------------
*/

$estadisticasWeb = [];

foreach ($meses as $numero => $nombre) {

    $estadisticasWeb[] = [
        'mes' => $nombre,
        'total' => (int) $reservasWebPorMes->get($numero, 0),
    ];
}
        return view(
            'admin_estadistica_reservas',
            compact(
                'estadisticasMeses',
                 'estadisticasWeb',
                'estadisticas',
                'year'
            )
        );
    }
}