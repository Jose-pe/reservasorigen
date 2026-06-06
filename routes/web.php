<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReservaController;
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
Route::get('/reservas_error', [App\Http\Controllers\ReservaController::class, 'reservas_error'])->name('reservas_error');
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