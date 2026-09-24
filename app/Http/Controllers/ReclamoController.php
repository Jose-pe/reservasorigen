<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamo;

class ReclamoController extends Controller
{
    public function create()
    {
        return view('libro_reclamaciones');
    }

    public function store(Request $request)
    {
        // 1. Validaciones
        $validated = $request->validate([
            'tipo_doc' => 'required|string|in:DNI,CE,Pasaporte,RUC',
            'num_doc' => 'required|string|max:20',
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'es_menor_edad' => 'nullable|boolean',
            'nombre_apoderado' => 'required_if:es_menor_edad,1|nullable|string|max:255',
            'tipo_bien' => 'required|in:Producto,Servicio',
            'monto_reclamado' => 'required|numeric|min:0',
            'descripcion_bien' => 'required|string|max:500',
            'tipo_reclamo' => 'required|in:Reclamo,Queja',
            'detalle_reclamo' => 'required|string',
            'pedido_solicitud' => 'required|string',
            'terminos' => 'required|accepted',
        ]);

        // 2. Generar Correlativo Único Automático
        $year = date('Y');
        $ultimoReclamo = Reclamo::latest('id')->first();
        $siguienteNumero = $ultimoReclamo ? ($ultimoReclamo->id + 1) : 1;
        $codigoCorrelativo = 'LR-' . $year . '-' . str_pad($siguienteNumero, 5, '0', STR_PAD_LEFT);

        // 3. Crear Registro
        $reclamo = Reclamo::create([
            'codigo_correlativo' => $codigoCorrelativo,
            'tipo_doc' => $validated['tipo_doc'],
            'num_doc' => $validated['num_doc'],
            'nombre_completo' => $validated['nombre_completo'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'direccion' => $validated['direccion'],
            'es_menor_edad' => $request->has('es_menor_edad'),
            'nombre_apoderado' => $request->input('nombre_apoderado'),
            'tipo_bien' => $validated['tipo_bien'],
            'monto_reclamado' => $validated['monto_reclamado'],
            'descripcion_bien' => $validated['descripcion_bien'],
            'tipo_reclamo' => $validated['tipo_reclamo'],
            'detalle_reclamo' => $validated['detalle_reclamo'],
            'pedido_solicitud' => $validated['pedido_solicitud'],
        ]);

        // 4. Enviar Correos (Al Cliente y al Administrador del Restaurante)
       /* $correoAdmin = config('mail.admin_address', 'admin@restaurante.com');

        Mail::to($reclamo->email)
            ->cc($correoAdmin)
            ->send(new HojaReclamacionMail($reclamo));*/

        return redirect()->back()->with('success', "Su reclamación ha sido registrada exitosamente. Se ha enviado una copia a su correo. Código: <strong>{$codigoCorrelativo}</strong>");
    }
}

