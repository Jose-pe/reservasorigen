<?php

namespace App\Http\Controllers;

use App\Models\DetalleReservas;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class DetalleReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reservas = DetalleReservas::all();        
        return view('admin_show_mesas')->with(['reserva' => $reservas]);
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
        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $input = $request->all();
        $input['id_admin'] = Auth::user()->email;       
        $input['state_asignation'] = "asignado";

       
        $detalle_reservation = DetalleReservas::create($input);

        return response()->json([
            'success' => true,
            'message' => "Mesa asignada a reserva",
            'detalle_reservation' => $detalle_reservation
        ], 201);
    }

    public function mostrar_reservas_mesas()
    {
            if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }

            
    } 

    /**
     * Display the specified resource.
     */
    public function show(DetalleReservas $detalleReservas)
    {
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
         $fecha = $request->input('reservation_date');
         $reservas = Reserva::all()->where('reservation_date', '=' , $fecha); 
        return view('admin_show_mesas', compact('reservas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleReservas $detalleReservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleReservas $detalleReservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetalleReservas $detalleReservas)
    {
        //
    }

   public function destroy_detalle_reserva(Request $request, $id_reserva)
{
    // 1. Validación de rol (opcional, manteniendo tu lógica previa)
    if (Auth::user()->role !== 'admin') {
         return view('welcome');
    }

    // 2. Buscar el registro por su ID
    $detalle = DetalleReservas::where('id_reserva' , $id_reserva);

    // 3. Si no existe, retornar un error 404
    if (!$detalle) {
        return response()->json(['error' => 'El detalle de la reserva no existe o ya fue eliminado'], 404);
    }

    // 4. Eliminar el registro
    $detalle->delete();

    // 5. Retornar respuesta de éxito
    return response()->json([
        'success' => true,
        'message' => 'El detalle de la reserva fue eliminado correctamente'
    ], 200);
}

}
