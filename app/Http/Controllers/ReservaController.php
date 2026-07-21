<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Exports\ReservasTomorrow;
use App\Exports\ReservasToday;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservas_comensales');
    }

    public function reservas_telefono()
    {
        $nombre_usuario = Auth::user()->name;
        $email_usuario = Auth::user()->email;
        return view('reservas_telefono',compact('nombre_usuario','email_usuario'));
    }
     public function reservas_fecha()
    {
        return view('reservas_fecha');
    }

     public function reservas_servicio()
    {
        return view('reservas_servicio');
    }

     public function reservas_hora()
    {
        return view('reservas_horas');
    }

      public function reservas_cliente()
    {
        if (Auth::check()) {
            return redirect()->route('reservas_fechas');
        }else{
            return view('reservas_cliente');
        }
        
    }

    public function reservas_preferencias()
    {
         $phone_usuario = Auth::user()->phone;
        return view('reservas_preferencias',compact('phone_usuario'));
    }

     public function finalizar_reserva()
    {
        return view('reservas_finalizar');
    }

      public function reservas_confirmacion()
    {   
        $id_user = Auth::user()->id;
        
        $nombre_usuario = Auth::user()->name;
        $email_usuario = Auth::user()->email;
        
        return view('reservas_confirmacion', compact('nombre_usuario','email_usuario'));
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
         $input = $request->all();
         $input['name'] = Auth::user()->name;
         $input['email'] = Auth::user()->email; 
         $input['id_admin'] = 'Usuario Web'; 
         $input['role'] = 'cliente';   
         
        $existe = Reserva::where([
        'email' => $input['email'],
        'reservation_date' => $input['reservation_date']        
        ])->exists();

        if ( $existe ) {
              return redirect()->route('reservas_error');
        }else{
         $reservation = Reserva::create($input);
        
        return response()->json([

            'success' => true,

            'message' => 'Reserva creada',

            'reservation' => $reservation

        ], 201);
        }
       

       
    }

     public function reservas_error()
    {
        return view('reservas_error');
    }

     public function reservas_error_admin()
    {
        return view('reservas_error_interno');
    }

     public function admin_login()
    {
        
        return view('admin_login');

    }
     public function admin_dashboard()
    {
            if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
            //reservas para hoy ordenadas por fecha y hora    
            $reservas = Reserva::whereDate('reservation_date','=' ,now()->toDateString())->where('state', '=', 'Confirmado')
                ->orderBy('reservation_date', 'asc')
                ->orderBy('reservation_time', 'asc')
                ->get();
            
            $reservas_siguientes = Reserva::whereDate('reservation_date','>' ,now()->toDateString())->where('state', '!=', 'Cancelado')
                ->orderBy('reservation_date', 'asc')
                ->orderBy('reservation_time', 'asc')                
                ->take(40)
                ->get();
            
            $reservas_pendientes = Reserva::whereDate('reservation_date','>=' ,now()->toDateString())->where('state', 'Pendiente')->orderBy('reservation_date', 'asc')->orderBy('reservation_time', 'asc')->get();
          //todas las  reservas ordenadas por fecha y hora    
            $reservas_states = Reserva::whereIn('state', ['Atendido', 'Cancelado'])->orderBy('reservation_date', 'asc')->orderBy('reservation_time', 'asc')->get();
            
            //fecha de creacion de la reserva
            $reservas_hoy = Reserva::whereDate('created_at', now()->toDateString())->where('state', 'Pendiente')->orderBy('reservation_date', 'asc')->orderBy('reservation_time', 'asc')->get();
               
            return view('admin_dashboard', compact('reservas', 'reservas_states', 'reservas_hoy', 'reservas_pendientes', 'reservas_siguientes'));
       
    }

    public function admin_create_reserva(Request $request)
    {   
        $input = $request->all();
        $existe = Reserva::where([
        'name' => $input['name'],
        'reservation_date' => $input['reservation_date']        
        ])->exists();

        if ( $existe ) {
              return redirect()->route('reservas_error_admin');
        }else{
       
        $input['role'] = 'cliente'; 
        $input['id_admin'] = Auth::user()->email;
        $reservation = Reserva::create($input);
        return redirect()->route('admin_dashboard')->with('status', 'Reserva creada exitosamente'); 
        }
    }

    public function admin_update_state(Request $request, $id)
    {  
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::find($id);
        $reserva->state = "Confirmado";
        $input['id_admin'] = Auth::user()->email;
        $reserva->label = $request->label; // Asegúrate de que el campo 'label' esté presente en tu formulario
        $reserva->pay_state = $request->pay_state;
        $reserva->save();
        return redirect()->back()->with('status', 'Estado de la reserva actualizado');
    }

     public function admin_atendido_state(Request $request, $id)
    {  
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::find($id);
        $reserva->state = "Atendido"; 
        $input['id_admin'] = Auth::user()->email;         
        $reserva->save();
        return redirect()->back()->with('status', 'Estado de la reserva actualizado');
    }

    public function admin_delete_state(Request $request, $id)
    {  
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::find($id);
        $input['id_admin'] = Auth::user()->email;
        $reserva->state = "Cancelado";        
        $reserva->save();
        return redirect()->back()->with('status', 'Estado de la reserva actualizado');
    }
     
    public function admin_filtros()
    {  
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
          $reservas = Reserva::latest('reservation_date')
    ->latest('reservation_time')
    ->get();                         
        return view('admin_filtros_dashboard', compact('reservas'));
    }

    public function admin_filtrar_email(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $email = $request->input('email');
        $reservas = Reserva::all()->where('email', '=' , $email); 
        return view('admin_filtros_dashboard', compact('reservas'));
    }

    public function admin_filtrar_fecha(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $fecha = $request->input('reservation_date');
        $reservas = Reserva::all()->where('reservation_date', '=' , $fecha); 
        return view('admin_filtros_dashboard', compact('reservas'));
    }

    public function admin_filtrar_etiqueta(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $etiqueta = $request->input('label');
        $reservas = Reserva::where('label', '=' , $etiqueta)->orderBy('reservation_date', 'desc')->get(); 
        return view('admin_filtros_dashboard', compact('reservas'));
    }

    public function admin_filtrar_by_admin(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $id_admin = $request->input('id_admin');
        $reservas = Reserva::where('id_admin', '=' , $id_admin)->orderBy('reservation_date', 'desc')->orderBy('reservation_time', 'desc')->get(); 
        return view('super_admin_table_reservas', compact('reservas'));
    }

    public function cliente_dashboard()
    {
        
        $name_user = Auth::user()->name;


        $reservas = Reserva::all()->where('email', '=' ,Auth::user()->email);
        return view('cliente_dashboard')->with(['reservas' => $reservas],['name' => $name_user]);

    }
    

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function admin_edit_reserva(Reserva $reserva, $id)
    {
        
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::find($id);
        return view('admin_edit_reserva', compact('reserva'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function admin_update_reserva(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $reserva = Reserva::find($id);
        $input = $request->all();
        $input['id_admin'] = Auth::user()->email;
        $reserva->update($input);
        return redirect()->route('admin_dashboard')->with('status', 'Reserva actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
       
       $reserva = Reserva::where('email' , Auth::user()->email)->where('id', $id);
       $reserva->delete();
       return redirect()->route('cliente_dashboard')->with('status','Reserva eliminada');
    }

       public function super_admin_filtrar_fecha(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $fecha = $request->input('reservation_date');
        $reservas = Reserva::all()->where('reservation_date', '=' , $fecha); 
        return view('super_admin_table_reservas', compact('reservas'));
    }

     public function super_admin_filtrar_email(Request $request){

        if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
        $email = $request->input('email');
        $reservas = Reserva::all()->where('email', '=' , $email); 
        return view('super_admin_table_reservas', compact('reservas'));
    }
    
     public function show_superadmin_reservas()
    {
         if (Auth::user()->role !== 'admin') {
                return view('welcome');
            }
            //reservas para hoy ordenadas por fecha y hora    
         $reservas = Reserva::orderBy('reservation_date', 'desc')->orderBy('reservation_time', 'desc')->get();
         return view('super_admin_table_reservas', compact('reservas'));
    }

    public function reporte_reservas_tomorrow()
    {
        // Generamos un nombre dinámico para el archivo con la fecha de mañana
        $dateStr = Carbon::tomorrow()->format('Y-m-d');
        $fileName = "reporte_reservas_origen_{$dateStr}.xlsx";

        return Excel::download(new ReservasTomorrow, $fileName);
    }

     public function reporte_reservas_today()
    {
        // Generamos un nombre dinámico para el archivo con la fecha de hoy
        $dateStr = Carbon::today()->format('Y-m-d');
        $fileName = "reporte_reservas_origen_hoy_{$dateStr}.xlsx";

        return Excel::download(new ReservasToday, $fileName);
    }
}
