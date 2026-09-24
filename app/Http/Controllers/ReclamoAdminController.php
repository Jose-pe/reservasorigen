<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reclamo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReclamoAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Reclamo::query();

        // Filtro por Estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por Tipo (Reclamo / Queja)
        if ($request->filled('tipo_reclamo')) {
            $query->where('tipo_reclamo', $request->tipo_reclamo);
        }

        // Búsqueda por Correlativo, Documento o Nombre
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('codigo_correlativo', 'LIKE', "%{$buscar}%")
                  ->orWhere('num_doc', 'LIKE', "%{$buscar}%")
                  ->orWhere('nombre_completo', 'LIKE', "%{$buscar}%");
            });
        }

        // Ordenar por más recientes
        $reclamos = $query->orderBy('created_at', 'desc')->paginate(15);

        // Métricas rápidas para el dashboard
        $totalPendientes = Reclamo::where('estado', 'Pendiente')->count();
        $totalAtendidos  = Reclamo::where('estado', 'Atendido')->count();
        $totalReclamos   = Reclamo::count();

        return view('admin_reclamos_index', compact('reclamos', 'totalPendientes', 'totalAtendidos', 'totalReclamos'));
    }

    /**
     * Detalle individual del reclamo.
     */
    public function show(Reclamo $reclamo)
    {
        return view('admin_reclamos_show', compact('reclamo'));
    }

    /**
     * Guardar la respuesta o actualizar el estado del reclamo.
     */
    public function responder(Request $request, Reclamo $reclamo)
    {
        $request->validate([
            'estado'              => 'required|in:Pendiente,Atendido',
            'respuesta_proveedor' => 'required_if:estado,Atendido|nullable|string',
        ]);

        $reclamo->update([
            'estado'              => $request->estado,
            'respuesta_proveedor' => $request->respuesta_proveedor,
            'fecha_respuesta'     => $request->estado === 'Atendido' ? now() : null,
        ]);

        return redirect()->route('admin_reclamos_show', $reclamo->id)
            ->with('success', 'El estado del reclamo ha sido actualizado correctamente.');
    }

    /**
     * Exportar todos los registros a CSV (Para entrega a INDECOPI o Auditoría).
     */
    public function exportCsv(): StreamedResponse
    {
        $fileName = 'libro_reclamaciones_' . date('Y-m-d') . '.csv';
        $reclamos = Reclamo::orderBy('id', 'desc')->get();

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        return response()->stream(function () use ($reclamos) {
            $file = fopen('php://output', 'w');
            // BOM UTF-8 para compatibilidad con Excel
            fputs($file, "\xEF\xBB\xBF");

            // Encabezados
            fputcsv($file, [
                'N° Correlativo', 'Fecha Registro', 'Tipo Doc', 'N° Doc', 'Consumidor', 
                'Email', 'Teléfono', 'Tipo Bien', 'Monto (S/)', 'Descripción Bien', 
                'Tipo Atención', 'Detalle', 'Pedido', 'Estado', 'Respuesta Proveedor', 'Fecha Respuesta'
            ]);

            foreach ($reclamos as $r) {
                fputcsv($file, [
                    $r->codigo_correlativo,
                    $r->created_at->format('d/m/Y H:i'),
                    $r->tipo_doc,
                    $r->num_doc,
                    $r->nombre_completo,
                    $r->email,
                    $r->telefono,
                    $r->tipo_bien,
                    $r->monto_reclamado,
                    $r->descripcion_bien,
                    $r->tipo_reclamo,
                    $r->detalle_reclamo,
                    $r->pedido_solicitud,
                    $r->estado,
                    $r->respuesta_proveedor,
                    $r->fecha_respuesta ? $r->fecha_respuesta->format('d/m/Y H:i') : ''
                ]);
            }
            fclose($file);
        }, 200, $headers);
    }
}