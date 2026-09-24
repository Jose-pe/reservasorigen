<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamo extends Model
{
    use HasFactory;

    protected $table = 'libro_reclamaciones';

    protected $fillable = [
        'codigo_correlativo',
        'tipo_doc',
        'num_doc',
        'nombre_completo',
        'email',
        'telefono',
        'direccion',
        'es_menor_edad',
        'nombre_apoderado',
        'tipo_bien',
        'monto_reclamado',
        'descripcion_bien',
        'tipo_reclamo',
        'detalle_reclamo',
        'pedido_solicitud',
        'estado',
        'respuesta_proveedor',
        'fecha_respuesta',
    ];

    protected $casts = [
        'fecha_respuesta' => 'datetime',
    ];
}