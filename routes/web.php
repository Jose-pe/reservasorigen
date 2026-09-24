<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReclamoAdminController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/eng', function () {
    return view('eng.welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/reservas_comensales', [App\Http\Controllers\ReservaController::class, 'index'])->name('reservas_comensales');
Route::get('/reservas_fechas', [App\Http\Controllers\ReservaController::class, 'reservas_fecha'])->name('reservas_fechas');
Route::get('/reservas_servicio', [App\Http\Controllers\ReservaController::class, 'reservas_servicio'])->middleware('auth')->name('reservas_servicio');
Route::get('/reservas_hora', [App\Http\Controllers\ReservaController::class, 'reservas_hora'])->middleware('auth')->name('reservas_hora');
Route::get('/reservas_cliente', [App\Http\Controllers\ReservaController::class, 'reservas_cliente'])->name('reservas_cliente');
Route::get('/reservas_preferencias', [App\Http\Controllers\ReservaController::class, 'reservas_preferencias'])->middleware('auth')->name('reservas_preferencias');
Route::get('/reservas_confirmacion', [App\Http\Controllers\ReservaController::class, 'reservas_confirmacion'])->middleware('auth')->name('reservas_confirmacion');
Route::post('/guardar_reserva', [App\Http\Controllers\ReservaController::class, 'store'])->middleware('auth')->name('guardar_reserva');
Route::get('/finalizar_reserva', [App\Http\Controllers\ReservaController::class, 'finalizar_reserva'])->middleware('auth')->name('finalizar_reserva');
Route::get('/reservas_error_comensales', [App\Http\Controllers\ReservaController::class, 'reservas_error_comensales'])->name('reservas_error_comensales');
Route::get('/reservas_error', [App\Http\Controllers\ReservaController::class, 'reservas_error'])->name('reservas_error');
Route::get('/reservas_error_admin', [App\Http\Controllers\ReservaController::class, 'reservas_error_admin'])->name('reservas_error_admin');
Route::get('/reservas_telefono', [App\Http\Controllers\ReservaController::class, 'reservas_telefono'])->name('reservas_telefono');
Route::get('/cliente_dashboard', [App\Http\Controllers\ReservaController::class, 'cliente_dashboard'])->middleware('auth')->name('cliente_dashboard');
Route::post('/reserva_delete/{id}', [App\Http\Controllers\ReservaController::class, 'destroy'])->middleware('auth')->name('reserva_delete');


Route::get('/admin_login', [App\Http\Controllers\ReservaController::class, 'admin_login'])->name('admin_login');

Route::get('/admin_dashboard', [App\Http\Controllers\ReservaController::class, 'admin_dashboard'])->middleware('admin','auth')->name('admin_dashboard');
Route::post('/admin_update_state/{id}', [App\Http\Controllers\ReservaController::class, 'admin_update_state'])->middleware('auth','admin')->name('admin_update_state');
Route::post('/admin_create_reserva', [App\Http\Controllers\ReservaController::class, 'admin_create_reserva'])->middleware('auth','admin')->name('admin_create_reserva');
Route::post('/admin_delete_reserva/{id}', [App\Http\Controllers\ReservaController::class, 'admin_delete_state'])->middleware('auth','admin')->name('admin_delete_reserva');
Route::post('/admin_atendido_state/{id}', [App\Http\Controllers\ReservaController::class, 'admin_atendido_state'])->middleware('auth','admin')->name('admin_atendido_state');
Route::get('/admin_filtros', [App\Http\Controllers\ReservaController::class, 'admin_filtros'])->middleware('auth','admin')->name('admin_filtros');
Route::get('/admin_edit_reserva/{id}', [App\Http\Controllers\ReservaController::class, 'admin_edit_reserva'])->middleware('auth','admin')->name('admin_edit_reserva');
Route::put('/admin_update_reserva/{id}', [App\Http\Controllers\ReservaController::class, 'admin_update_reserva'])->middleware('auth','admin')->name('admin_update_reserva');
Route::get('/admin_filtrar_email', [App\Http\Controllers\ReservaController::class, 'admin_filtrar_email'])->middleware('auth','admin')->name('admin_filtrar_email');
Route::get('/admin_filtrar_fecha', [App\Http\Controllers\ReservaController::class, 'admin_filtrar_fecha'])->middleware('auth','admin')->name('admin_filtrar_fecha');
Route::get('/admin_filtrar_etiqueta', [App\Http\Controllers\ReservaController::class, 'admin_filtrar_etiqueta'])->middleware('auth','admin')->name('admin_filtrar_etiqueta');
Route::get('/admin_reclamos_index', [ReclamoAdminController::class, 'index'])->middleware('auth','admin')->middleware('auth','admin')->name('admin_reclamos_index');
Route::get('/admin_reclamos_exportar', [ReclamoAdminController::class, 'exportCsv'])->middleware('auth','admin')->name('admin_reclamos_export');
Route::get('/admin_reclamos/{reclamo}', [ReclamoAdminController::class, 'show'])->middleware('auth','admin')->name('admin_reclamos_show');
Route::put('/admin_reclamos/{reclamo}/responder', [ReclamoAdminController::class, 'responder'])->middleware('auth','admin')->name('admin_reclamos_responder');
Route::get('/admin_estadisticas_reservas', [EstadisticaController::class, 'reservas'])->middleware('auth','admin')->name('admin_estadisticas_reservas');
//reportes
Route::get('/reservas_reporte', [App\Http\Controllers\ReservaController::class, 'reporte_reservas_tomorrow'])->middleware('auth','admin')->name('reservas_reporte');
Route::get('/reservas_reporte_hoy', [App\Http\Controllers\ReservaController::class, 'reporte_reservas_today'])->middleware('auth','admin')->name('reservas_reporte_hoy');

Route::get('/show_superadmin_reservas', [App\Http\Controllers\ReservaController::class, 'show_superadmin_reservas'])->middleware('auth','admin')->name('show_superadmin_reservas');
Route::get('/admin_filtrar_by_admin', [App\Http\Controllers\ReservaController::class, 'admin_filtrar_by_admin'])->middleware('auth','admin')->name('admin_filtrar_by_admin');
Route::get('/super_admin_filtrar_fecha', [App\Http\Controllers\ReservaController::class, 'super_admin_filtrar_fecha'])->middleware('auth','admin')->name('super_admin_filtrar_fecha');
Route::get('/super_admin_filtrar_email', [App\Http\Controllers\ReservaController::class, 'super_admin_filtrar_email'])->middleware('auth','admin')->name('super_admin_filtrar_email');

//GESTION DE MESAS Y HORAS
Route::get('/gestion_mesas_query', [App\Http\Controllers\MesaController::class, 'index'])->middleware('auth','admin')->name('gestion_mesas_query');
Route::get('/gestion_mesas/{id}', [App\Http\Controllers\MesaController::class, 'mostrar_reserva'])->middleware('auth','admin')->name('gestion_mesas');
Route::get('/listar_mesas', [App\Http\Controllers\MesaController::class, 'getMesasEstado'])->middleware('auth','admin')->name('listar_mesas');
Route::get('/listar_mesas_json', [App\Http\Controllers\MesaController::class, 'listar_mesas_json'])->middleware('auth','admin')->name('listar_mesas_json');
Route::post('/guardar_mesas', [App\Http\Controllers\MesaController::class, 'guardar_mesas'])->middleware('auth','admin')->name('guardar_mesas');
Route::get('/mostrar_reservas_confirmadas', [App\Http\Controllers\ReservaController::class, 'show_reservas_confirmadas'])->middleware('auth','admin')->name('mostrar_reservas_confirmadas');
Route::get('/get_reservas_mesas', [App\Http\Controllers\ReservaController::class, 'get_reservas_mesas'])->middleware('auth','admin')->name('get_reservas_mesas');
Route::post('/update_mesas_asignacion/{id}', [App\Http\Controllers\ReservaController::class, 'update_mesas_asignacion'])->middleware('auth','admin')->name('update_mesas_asignacion');
Route::put('/update_mesas_quitar_asignacion/{id}', [App\Http\Controllers\ReservaController::class, 'update_mesas_quitar_asignacion'])->middleware('auth','admin')->name('update_mesas_quitar_asignacion');
Route::put('/mesas_atendido_state/{id}', [App\Http\Controllers\ReservaController::class, 'mesas_atendido_state'])->middleware('auth','admin')->name('mesas_atendido_state');


//LIBRO DE RECLAMACIONES
Route::get('/libro-de-reclamaciones', [ReclamoController::class, 'create'])->name('libro-reclamaciones.create');
Route::post('/libro-de-reclamaciones', [ReclamoController::class, 'store'])->name('libro-reclamaciones.store');

//DETALLE DE RESERVA
Route::delete('/destroy_detalle_reserva/{id_reserva}', [App\Http\Controllers\DetalleReservasController::class, 'destroy_detalle_reserva'])->middleware('auth','admin')->name('destroy_detalle_reserva');
Route::post('/guardar_detalle_reserva',[App\Http\Controllers\DetalleReservasController::class, 'store'])->middleware('auth','admin')->name('guardar_detalle_reserva');
Route::get('/mostrar_porfecha', [App\Http\Controllers\DetalleReservasController::class, 'mostrar_porfecha'])->middleware('auth','admin')->name('/mostrar_porfecha');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::post('/logoutgoogle', function (Request $request) {
    // Cerrar sesión en Laravel
    Auth::guard('web')->logout();

    // Invalidar la sesión y regenerar el token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Redirige a la página principal
})->name('logoutgoogle')->middleware('auth');