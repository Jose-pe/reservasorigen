<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel Administrador - Reclamo </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
 <style>
    body { background-color: #f5f6fa; }
    .sidebar { height: 20vh; background: #1e1e2f; color: white; }
    .sidebar a { color: #ccc; text-decoration: none; display: inline-block; padding: 12px 20px; cursor:pointer; }
    .sidebar a:hover, .sidebar a.active { background: #343a40; color: #fff; }
    .card { border-radius: 15px; }
    .section { display:none; }
    .section.active { display:block; }
     td{
      text-align: center !important;
    }
     th{
      text-align: center !important;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  
    <div class="row">
    <!-- Sidebar -->
    <div class="col-12 p-0 sidebar">
      <h4 class="text-center py-4">🍽 Admin</h4>
      <a href="{{ route('admin_dashboard') }}"><i class="fa-solid fa-gauge-high fa-lg" style="color: rgb(255, 255, 255);"></i> Dashboard</a>
      <a  href="{{route('admin_reclamos_index')}}"><i class="fa-brands fa-leanpub fa-lg" style="color: rgb(255, 255, 255);"></i> Quejas y Reclamos </a>
       <a  href="{{route('admin_estadisticas_reservas')}}"><i class="fa-solid fa-chart-simple fa-lg" style="color: rgb(255, 255, 255);"></i> Estadisticas </a>
      <a  href="{{route('admin_filtros')}}"><i class="fa-solid fa-filter fa-lg" style="color: rgb(255, 255, 255);"></i> Más filtros</a>
      <a  href="{{route('show_superadmin_reservas')}}"><i class="fa-solid fa-users fa-lg" style="color: rgb(255, 255, 255);"></i> Ver registro de actividades</a>
      {{--<a onclick="showSection('horarios')"><i class="bi bi-clock"></i> Horarios</a>--}}
      {{-- <a onclick="showSection('mesas')"><i class="bi bi-table"></i> Mesas</a>
     <a onclick="showSection('horarios')"><i class="bi bi-clock"></i> Horarios</a>--}}
    </div>
    </div>
    <!-- Main Content -->
    <div class="col-12 p-4">
      <div class="row">
       
            <div class="col-12 text-end">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    
                <button type="submit" class=" justify-content-end mb-4">
                    <i class="bi bi-power"></i> Cerrar sesión
                </button>
            </form></div>
        
      </div>
    </div>
      @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">
    <!-- Ficha Detallada del Reclamo -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold m-0 text-primary">
                    <i class="bi bi-file-earmark-text me-2"></i>Hoja de Reclamación N° {{ $reclamo->codigo_correlativo }}
                </h5>
                <span class="badge {{ $reclamo->estado === 'Atendido' ? 'bg-success' : 'bg-warning text-dark' }} fs-6">
                    {{ $reclamo->estado }}
                </span>
            </div>
            <div class="card-body">

                <h6 class="fw-bold border-bottom pb-2 text-secondary">1. Datos del Consumidor</h6>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>Nombre / Razón Social:</strong> {{ $reclamo->nombre_completo }}</div>
                    <div class="col-md-6"><strong>Documento:</strong> {{ $reclamo->tipo_doc }} - {{ $reclamo->num_doc }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>Correo Electrónico:</strong> {{ $reclamo->email }}</div>
                    <div class="col-md-6"><strong>Teléfono:</strong> {{ $reclamo->telefono }}</div>
                </div>
                <div class="mb-3">
                    <strong>Dirección:</strong> {{ $reclamo->direccion }}
                </div>
                @if($reclamo->es_menor_edad)
                    <div class="alert alert-info py-2">
                        <small><strong>Menor de edad. Apoderado:</strong> {{ $reclamo->nombre_apoderado }}</small>
                    </div>
                @endif

                <h6 class="fw-bold border-bottom pb-2 text-secondary mt-4">2. Identificación del Bien Contratado</h6>
                <div class="row mb-3">
                    <div class="col-md-6"><strong>Tipo de Bien:</strong> {{ $reclamo->tipo_bien }}</div>
                    <div class="col-md-6"><strong>Monto Reclamado:</strong> S/ {{ number_format($reclamo->monto_reclamado, 2) }}</div>
                </div>
                <div class="mb-3">
                    <strong>Descripción del Bien/Servicio:</strong>
                    <p class="text-muted mb-0">{{ $reclamo->descripcion_bien }}</p>
                </div>

                <h6 class="fw-bold border-bottom pb-2 text-secondary mt-4">3. Detalle de la Reclamación</h6>
                <div class="mb-3">
                    <strong>Tipo:</strong> 
                    <span class="badge {{ $reclamo->tipo_reclamo === 'Reclamo' ? 'bg-danger' : 'bg-warning text-dark' }}">
                        {{ $reclamo->tipo_reclamo }}
                    </span>
                </div>
                <div class="mb-3">
                    <strong>Detalle del Reclamo / Queja:</strong>
                    <div class="p-3 bg-light rounded mt-1">{{ $reclamo->detalle_reclamo }}</div>
                </div>
                <div class="mb-3">
                    <strong>Pedido Concreto del Consumidor:</strong>
                    <div class="p-3 bg-light rounded mt-1">{{ $reclamo->pedido_solicitud }}</div>
                </div>

            </div>
            <div class="card-footer bg-white text-muted small">
                Fecha de Registro: {{ $reclamo->created_at->format('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>

    <!-- Panel de Atención y Respuesta -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title fw-bold m-0">Atención del Reclamo</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin_reclamos_responder', $reclamo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="estado" class="form-label fw-bold">Estado de Atención *</label>
                        <select name="estado" id="estado" class="form-select" onchange="toggleRespuesta(this.value)">
                            <option value="Pendiente" {{ old('estado', $reclamo->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="Atendido" {{ old('estado', $reclamo->estado) == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                        </select>
                    </div>

                    <div class="mb-3" id="wrapper_respuesta">
                        <label for="respuesta_proveedor" class="form-label fw-bold">Respuesta Oficial del Restaurante</label>
                        <textarea name="respuesta_proveedor" id="respuesta_proveedor" rows="5" class="form-control" placeholder="Detalle la respuesta, solución otorgada o descargos para el cliente...">{{ old('respuesta_proveedor', $reclamo->respuesta_proveedor) }}</textarea>
                        <small class="text-muted">Plazo máximo de respuesta según INDECOPI: 15 días hábiles.</small>
                    </div>

                    @if($reclamo->fecha_respuesta)
                        <div class="alert alert-success small py-2 mb-3">
                            <strong>Atendido el:</strong> {{ $reclamo->fecha_respuesta->format('d/m/Y H:i') }}
                        </div>
                    @endif

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
     
        
   

      <!-- RESERVAS -->
      
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>