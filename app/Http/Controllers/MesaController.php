<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Reserva;
use App\Models\DetalleReservas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (Auth::user()->role !== 'admin') {
                    return view('welcome');
                }

            return view('admin_show_mesas');
    }

    public function listar_mesas_json()
    {
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }

        $mesas = Mesa::all();
        return response()->json($mesas);
    }
    
    public function guardar_mesas(Request $request){
             if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $input = $request->all();
        $mesa = Mesa::create($input);
        return response()->json(['success' => true, 'mesa' => $mesa], 201);

    }

     public function mostrar_reserva($id){
        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::findOrFail($id);        
        return view('admin_mesas')->with(['reserva' => $reserva]);
    }

   

    public function change_state_mesa(Request $request, $id){
          if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $mesa = Mesa::find($id);
       // $mesa->state_mesa = $request->state_m
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mesa $mesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mesa $mesa)
    {
        //
    }
    public function getMesasEstado(Request $request)
{
    $request->validate([
        'fecha' => 'nullable|date_format:Y-m-d',
        'hora' => 'required|date_format:H:i:s',
    ]);

    $fecha = $request->input('fecha');
    $horaInicio = $request->input('hora_inicio');
    
    // Asignamos una duración por defecto de 2 horas
    $horaInicio = Carbon::parse($request->input('hora'))->format('H:i:s');
    $horaFin = Carbon::parse($request->input('hora'))->addMinutes(01)->format('H:i:s');

    // Consultamos las mesas e incluimos su reserva activa en ese rango
    $mesas = Mesa::with(['DetalleReservas' => function ($query) use ($fecha, $horaInicio, $horaFin) {
        $query->where('reservation_date', $fecha)
              ->where('reservation_time', '<', $horaFin)
              ->where('reservation_out', '>', $horaInicio)
              ->where('state_asignation', '!=', 'cancelado'); // Ignorar cancelados
    }])->get();

    // Mapeamos para indicar dinámicamente si la mesa está disponible u ocupada
    $resultado = $mesas->map(function ($mesa) {
        $reservaActiva = $mesa->DetalleReservas->first();
        return [
            'id' => $mesa->id,
            'number' => $mesa->number,
            'capacity' => $mesa->capacity,
            'shape' => $mesa->shape,
            'zone' => $mesa->zone,
            'x' => $mesa->x,
            'y' => $mesa->y,
            // Estado dinámico calculado para la hora consultada
            'is_occupied' => !is_null($reservaActiva),
            'reserva_info' => $reservaActiva
        ];
    });

    return response()->json($resultado);
}
}
