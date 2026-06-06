<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel Administrador - Editar Reservas </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
  <link rel="stylesheet" href="/css/admin_edit.css"/>
 <style>
    body { background-color: #f5f6fa; }
    .sidebar { height: 20vh; background: #1e1e2f; color: white; }
    .sidebar a { color: #ccc; text-decoration: none; display: inline-block; padding: 12px 20px; cursor:pointer; }
    .sidebar a:hover, .sidebar a.active { background: #343a40; color: #fff; }
    .card { border-radius: 15px; }
    .section { display:none; }
    .section.active { display:block; }
  </style>
</head>
<body>

<div class="container-fluid">
     <div class="row">
    <!-- Sidebar -->
    <div class="col-12 p-0 sidebar">
      <h4 class="text-center py-4">🍽 Admin</h4>
      <a href="{{ route('admin_dashboard') }}"><i class="fa-solid fa-gauge-high fa-lg" style="color: rgb(255, 255, 255);"></i> Dashboard</a>
      <a href="{{ route('admin_filtros') }}"><i class="fa-solid fa-filter fa-lg" style="color: rgb(255, 255, 255);"></i> Más filtros</a>
      {{-- <a onclick="showSection('mesas')"><i class="bi bi-table"></i> Mesas</a>
     <a onclick="showSection('horarios')"><i class="bi bi-clock"></i> Horarios</a>--}}
    </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            {{-- Tarjeta Principal --}}
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h4 class="fw-bold text-dark mb-0">Editar Reserva #{{ $reserva->id }}</h4>
                    <p class="text-muted small mt-1">Actualiza los datos del cliente y los detalles del servicio.</p>
                </div>

                <div class="card-body p-4">
                    {{-- Formulario apuntando a la ruta update con el método PUT --}}
                    <form action="{{ route('admin_update_reserva', $reserva->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Cliente --}}
                        <div class="mb-3">
                            <label for="name" class="form-label text-muted fw-semibold mb-1">Cliente</label>
                            <input type="text" class="form-control form-control-modern @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $reserva->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- E-mail --}}
                        <div class="mb-3">
                            <label for="email" class="form-label text-muted fw-semibold mb-1">E-mail</label>
                            <input type="email" class="form-control form-control-modern @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $reserva->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div class="mb-3">
                            <label for="telefono" class="form-label text-muted fw-semibold mb-1">Teléfono</label>
                            <input type="tel" class="form-control form-control-modern @error('telefono') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $reserva->phone) }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Personas --}}
                        <div class="mb-3">
                            <label for="personas" class="form-label text-muted fw-semibold mb-1">Personas</label>
                            <input type="number" class="form-control form-control-modern @error('guests') is-invalid @enderror" id="guests" name="guests" value="{{ old('guests', $reserva->guests) }}" required min="1">
                            @error('guests') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Fecha y Hora --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="fecha" class="form-label text-muted fw-semibold mb-1">Fecha</label>
                                <div class="input-group">
                                    <input type="date" class="form-control form-control-modern @error('reservation_date') is-invalid @enderror" id="reservation_date" name="reservation_date" value="{{ old('reservation_date', $reserva->reservation_date ? \Carbon\Carbon::parse($reserva->reservation_date)->format('Y-m-d') : '') }}" required>
                                </div>
                                @error('reservation_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="hora" class="form-label text-muted fw-semibold mb-1">Hora</label>
                                <div class="input-group">
                                    <input type="time" class="form-control form-control-modern @error('reservation_time') is-invalid @enderror" id="reservation_time" name="reservation_time" value="{{ old('reservation_time', $reserva->reservation_time ? \Carbon\Carbon::parse($reserva->reservation_time)->format('H:i') : '') }}" required>
                                </div>
                                @error('reservation_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                       
                        <div class="mb-3">
                            <label for="service" class="form-label text-muted fw-semibold mb-1">Seleccione el servicio</label>
                            <select class="form-select form-select-modern @error('service') is-invalid @enderror" id="service" name="service" required>
                               
                                    <option value="{{ $reserva->service }}" {{ old('service', $reserva->service) ==  $reserva->service ? 'selected' : '' }}>
                                        {{ $reserva->service }}
                                    <option value="Almuerzo">Almuerzo</option>
                                    <option value="Cena">Cena</option>     
                               
                            </select>
                            @error('service') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Restricciones alimentarias --}}
                        <div class="mb-3">
                            <label for="food_restricciones" class="form-label text-muted fw-semibold mb-1">Restricciones alimentarias</label>
                            <textarea class="form-control form-control-modern @error('food_description') is-invalid @enderror" id="food_description" name="food_description" rows="2">{{ old('food_description', $reserva->food_description) }}</textarea>
                            @error('food_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Niños menores de 12 años --}}
                        <div class="mb-3">
                            <label for="kids_count" class="form-label text-muted fw-semibold mb-1">Niños menores de 12 años</label>
                            <input type="number" class="form-control form-control-modern @error('kids_count') is-invalid @enderror" id="kids_count" name="kids_count" value="{{ old('kids_count', $reserva->kids_count) }}" min="0">
                            @error('kids_count') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Etiqueta --}}
                        <div class="mb-3">
                            <label for="etiqueta_id" class="form-label text-muted fw-semibold mb-1">Seleccione la etiqueta</label>
                            <select class="form-select form-select-modern @error('label') is-invalid @enderror" id="label" name="label">
                                                               
                                    <option value="{{ $reserva->label }}" {{ old('label', $reserva->label) == $reserva->label ? 'selected' : '' }}>
                                        {{ $reserva->label }}
                                    </option>
                                    <option value="FITS">FITS</option>
                                    <option value="Grupo de agencias">Grupo de agencias</option>
                                    <option value="Grupo de guias">Grupo de guias</option>
                                    <option value="Invitación">Invitación</option>        
                                    <option value="Servicio Regular">Servicio Regular</option>     
                                
                            </select>
                            @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="mb-4">
                            <label for="state" class="form-label text-muted fw-semibold mb-1">Seleccione el estado</label>
                            <select class="form-select form-select-modern @error('state') is-invalid @enderror" id="state" name="state" required>
                              
                                    <option value="{{ $reserva->state }}" {{ old('state', $reserva->state) == $reserva->state ? 'selected' : '' }}>
                                        {{ $reserva->state }}
                                    </option>
                                     <option value="Pendiente">Pendiente</option>
                                     <option value="Confirmado">Confirmado</option>  
                               
                            </select>
                            @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Botones de acción --}}
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-modern-primary text-white px-4 fw-semibold">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


