<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel Administrador - Libro de reclamaciones</title>
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
      <a class="active" href="#"><i class="fa-brands fa-leanpub fa-lg" style="color: rgb(255, 255, 255);"></i> Quejas y Reclamos </a>
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
      <div class="row mb-4">
    <div class="col">
        <h1 class="h3 fw-bold text-gray-800">Atención de Hojas de Reclamación</h1>
        <p class="text-muted">Gestione los reclamos y quejas registrados conforme a la normativa de INDECOPI.</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin_reclamos_export') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-file-earmark-excel me-1"></i> Exportar a CSV / Excel
        </a>
    </div>
</div>

<!-- Tarjetas de Métricas -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-primary border-4">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registrados</div>
                <div class="h3 mb-0 fw-bold text-dark">{{ $totalReclamos }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-warning border-4">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendientes (Plazo 15 días)</div>
                <div class="h3 mb-0 fw-bold text-dark">{{ $totalPendientes }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border-start border-success border-4">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Atendidos</div>
                <div class="h3 mb-0 fw-bold text-dark">{{ $totalAtendidos }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros de Búsqueda -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin_reclamos_index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por Correlativo, DNI o Nombre..." value="{{ request('buscar') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select">
                    <option value="">-- Todos los Estados --</option>
                    <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Atendido" {{ request('estado') == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="tipo_reclamo" class="form-select">
                    <option value="">-- Todos los Tipos --</option>
                    <option value="Reclamo" {{ request('tipo_reclamo') == 'Reclamo' ? 'selected' : '' }}>Reclamo</option>
                    <option value="Queja" {{ request('tipo_reclamo') == 'Queja' ? 'selected' : '' }}>Queja</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Filtrar</button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de Registros -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Correlativo</th>
                        <th>Fecha</th>
                        <th>Consumidor</th>
                        <th>Documento</th>
                        <th>Tipo</th>
                        <th>Bien</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reclamos as $r)
                        @php
                            // Cálculo de días transcurridos para advertencia de plazo legal (15 días)
                            $diasTranscurridos = (int) $r->created_at->diffInDays(now());
                            $alertaPlazo = ($r->estado === 'Pendiente' && $diasTranscurridos >= 10);
                        @endphp
                        <tr class="{{ $alertaPlazo ? 'table-warning' : '' }}">
                            <td class="fw-bold">{{ $r->codigo_correlativo }}</td>
                            <td>
                                <small class="text-muted">{{ $r->created_at->format('d/m/Y') }}</small><br>
                                <small class="text-muted">{{ $r->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div>{{ $r->nombre_completo }}</div>
                                <small class="text-muted">{{ $r->email }}</small>
                            </td>
                            <td>{{ $r->tipo_doc }}: {{ $r->num_doc }}</td>
                            <td>
                                <span class="badge {{ $r->tipo_reclamo === 'Reclamo' ? 'bg-danger' : 'bg-warning text-dark' }}">
                                    {{ $r->tipo_reclamo }}
                                </span>
                            </td>
                            <td>{{ $r->tipo_bien }}</td>
                            <td>S/ {{ number_format($r->monto_reclamado, 2) }}</td>
                            <td>
                                @if($r->estado === 'Pendiente')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>Pendiente ({{ $diasTranscurridos }}d)
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Atendido
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin_reclamos_show', $r->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> Ver Detalle
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                No se encontraron registros de reclamaciones.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reclamos->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $reclamos->withQueryString()->links() }}
        </div>
    @endif
</div>

      <!-- REclamos -->
      
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>