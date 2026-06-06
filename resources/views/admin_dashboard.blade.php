<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel Administrador - Reservas</title>
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
  </style>
</head>
<body>

<div class="container-fluid">
  
    <div class="row">
    <!-- Sidebar -->
    <div class="col-12 p-0 sidebar">
      <h4 class="text-center py-4">🍽 Admin</h4>
      <a class="active" onclick="showSection('dashboard')"><i class="fa-solid fa-gauge-high fa-lg" style="color: rgb(255, 255, 255);"></i> Dashboard</a>
      <a onclick="showSection('reservas_pendientes')"><i class="fa-solid fa-thumbtack fa-lg" style="color: rgb(255, 255, 255);"></i> Reservas pendientes</a>
      <a onclick="showSection('reservas_hoy')"><i class="fa-solid fa-calendar-day fa-lg" style="color: rgb(255, 255, 255);"></i> Reservas creadas hoy</a>
      <a onclick="showSection('reservas')"><i class="fa-solid fa-book fa-lg" style="color: rgb(255, 255, 255);"></i> Reservas Atendidas y Canceladas</a>
      <a href="{{route('admin_filtros')}}"><i class="fa-solid fa-filter fa-lg" style="color: rgb(255, 255, 255);"></i> Más filtros</a>
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
      <!-- DASHBOARD -->
      <div id="dashboard" class="section active">
        
       
      <!-- Stats -->
     {{-- <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card shadow p-3">
            <h6>Reservas Realizadas <h6>
            <h3>12</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow p-3">
            <h6>Mesas Ocupadas</h6>
            <h3>8</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow p-3">
            <h6>Disponibles</h6>
            <h3>5</h3>
          </div>
        </div>
      </div>--}}

      <!-- Table Reservas -->
      <div class="card shadow pt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
           <div class="col-6 text-start">
          <h2 class="mb-4 fw-bold">Reservas para hoy {{ now()->format('d/m/Y') }}</h2>
        </div>
        <div class="col-6 text-end">
          <button class="btn btn-dark btn-lg" onclick="openModal()">Nueva Reserva</button>
        </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th>Comensales</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Restricciones</th>
                <th>Niños</th>
                <th>Etiqueta</th>
                <th>Estado</th>                
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($reservas as $reserva)
                  <tr>
                <td>{{$reserva->name}}</td>
                <td>{{$reserva->email}}</td>
                <td>{{$reserva->phone}}</td>
                <td class="text-center">{{$reserva->guests}}</td>
                <td>{{$reserva->reservation_date}}</td>
                <td>{{$reserva->reservation_time}}</td>
                <td>{{$reserva->service}}</td>
                <td>{{$reserva->food_description}}</td>
                <td class="text-center" >{{$reserva->kids_count}}</td>
                <td> {{$reserva->label}}</td>
                @if ($reserva->state === 'Pendiente')
                <td ><a class="badge bg-warning  text-dark  p-2">{{$reserva->state}}</a></td>
                @endif
                @if ($reserva->state === 'Confirmado')
                <td ><a class="badge bg-success p-2">{{$reserva->state}}</a></td>
                @endif
                 @if ($reserva->state === 'Cancelado')
                <td ><a class="badge bg-danger p-2">{{$reserva->state}}</a></td>
                @endif
               
                
                <td>  
                  <form action="{{ route('admin_atendido_state', ['id' => $reserva->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                   <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-user-check" style="color: rgb(255, 255, 255);"></i></button>

                </form> 
                  <form action="{{ route('admin_delete_reserva', ['id' => $reserva->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-circle-xmark fa-lg" style="color: rgb(255, 255, 255);"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
        

       <div class="card shadow pt-2 mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
           <div class="col-12 text-start">
          <h2 class="mb-4 fw-bold">Siguientes reservas </h2>
        </div>
      
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th>Comensales</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Restricciones</th>
                <th>Niños</th>
                <th>Etiqueta</th>
                <th>Estado</th>                
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($reservas_siguientes as $reserva_siguiente)
                  <tr>
                <td>{{$reserva_siguiente->name}}</td>
                <td>{{$reserva_siguiente->email}}</td>
                <td>{{$reserva_siguiente->phone}}</td>
                <td class="text-center">{{$reserva_siguiente->guests}}</td>
                <td>{{$reserva_siguiente->reservation_date}}</td>
                <td>{{$reserva_siguiente->reservation_time}}</td>
                <td>{{$reserva_siguiente->service}}</td>
                <td>{{$reserva_siguiente->food_description}}</td>
                <td class="text-center" >{{$reserva_siguiente->kids_count}}</td>
                <td> {{$reserva_siguiente->label}}</td>
                @if ($reserva_siguiente->state === 'Pendiente')
                <td ><a class="badge bg-warning  text-dark  p-2">{{$reserva_siguiente->state}}</a></td>
                @endif
                @if ($reserva_siguiente->state === 'Confirmado')
                <td ><a class="badge bg-success p-2">{{$reserva_siguiente->state}}</a></td>
                @endif
                @if ($reserva_siguiente->state === 'Cancelado')
                <td ><a class="badge bg-danger p-2">{{$reserva_siguiente->state}}</a></td>
                @endif  
                  <td>           
                 
                    <form action="{{ route('admin_edit_reserva', ['id' => $reserva_siguiente->id]) }}" method="get" style="display:inline-block;">     
                    @csrf
                    @method('GET')           
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                  </form>
                
                  <form action="{{ route('admin_delete_reserva', ['id' => $reserva_siguiente->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-circle-xmark fa-lg" style="color: rgb(255, 255, 255);"></i></button>
                  </form>                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
        
      </div>

      <!-- RESERVAS -->
      <div id="reservas" class="section">
        <h2 class="mb-4">Reservas</h2>
        <div class="card">
          <div class="card-body table-responsive">
              <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th>Comensales</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Restricciones</th>
                <th>Niños</th>
                <th>Etiqueta</th>
                <th>Estado</th>                
               
              </tr>
            </thead>
            <tbody>
              
              @foreach ($reservas_states as $reserva_state)
                 <tr>
                <td>{{$reserva_state->name}}</td>
                <td>{{$reserva_state->email}}</td>
                <td>{{$reserva_state->phone}}</td>
                <td class="text-center">{{$reserva_state->guests}}</td>
                <td>{{$reserva_state->reservation_date}}</td>
                <td>{{$reserva_state->reservation_time}}</td>
                <td>{{$reserva_state->service}}</td>
                <td>{{$reserva_state->food_description}}</td>
                <td class="text-center" >{{$reserva_state->kids_count}}</td>
                <td> {{$reserva_state->label}}</td>
                @if ($reserva_state->state === 'Pendiente')
                <td ><a class="badge bg-warning  text-dark  p-2">{{$reserva_state->state}}</a></td>
                @endif
                @if ($reserva_state->state === 'Confirmado')
                <td ><a class="badge bg-success p-2">{{$reserva_state->state}}</a></td>
                @endif
                @if ($reserva_state->state === 'Cancelado')
                <td ><a class="badge bg-danger p-2">{{$reserva_state->state}}</a></td>
                @endif 
                @if ($reserva_state->state === 'Atendido')
                <td ><a class="badge bg-primary p-2">{{$reserva_state->state}}</a></td>
                @endif 
                 {{-- <td >  
                   <form action="{{ route('admin_edit_reserva', ['id' => $reserva_state->id]) }}" method="get" style="display:inline-block;">     
                    @csrf
                    @method('GET')           
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                  </form>
                    
                  <form action="{{ route('admin_delete_reserva', ['id' => $reserva_state->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-circle-xmark fa-lg" style="color: rgb(255, 255, 255);"></i></button>
                  </form>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          </div>
        </div>
      </div>


       <div id="reservas_pendientes" class="section">
        <h2 class="mb-4">Reservas pendientes</h2>
        <div class="card">
          <div class="card-body table-responsive">
              <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th>Comensales</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Restricciones</th>
                <th>Niños</th>
                <th>Etiqueta</th>
                <th>Estado</th>                
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($reservas_pendientes as $reserva_pendiente)
                 <tr>
                <td>{{$reserva_pendiente->name}}</td>
                <td>{{$reserva_pendiente->email}}</td>
                <td>{{$reserva_pendiente->phone}}</td>
                <td class="text-center">{{$reserva_pendiente->guests}}</td>
                <td>{{$reserva_pendiente->reservation_date}}</td>
                <td>{{$reserva_pendiente->reservation_time}}</td>
                <td>{{$reserva_pendiente->service}}</td>
                <td>{{$reserva_pendiente->food_description}}</td>
                <td class="text-center" >{{$reserva_pendiente->kids_count}}</td>
                  <form action="{{ route('admin_update_state', ['id' => $reserva_pendiente->id]) }}" method="post">
                 
                    @csrf
                    @method('POST')
                  <td> <select class="form-select" id="label" name="label" required>
                     <option value="{{ $reserva_pendiente->label }}" {{ old('label', $reserva_pendiente->label) == $reserva_pendiente->label ? 'selected' : '' }}>
                                        {{ $reserva_pendiente->label }}
                                    </option>
                  
                  <option value="Servicio Regular">Servicio Regular</option>
                  <option value="FITS">FITS</option>
                  <option value="Grupo de agencias">Grupo de agencias</option>
                  <option value="Grupo de guias">Grupo de guias</option>
                  <option value="Invitación">Invitación</option>
                </select></td>
                @if ($reserva_pendiente->state === 'Pendiente')
                <td ><a class="badge bg-warning  text-dark  p-2">{{$reserva_pendiente->state}}</a></td>
                @endif
                @if ($reserva_pendiente->state === 'Confirmado')
                <td ><a class="badge bg-success p-2">{{$reserva_pendiente->state}}</a></td>
                @endif
                @if ($reserva_pendiente->state === 'Cancelado')
                <td ><a class="badge bg-danger p-2">{{$reserva_pendiente->state}}</a></td>
                @endif
                 <td>                   
                    <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-square"></i></button>
                  </form>            
                    <form action="{{ route('admin_edit_reserva', ['id' => $reserva_pendiente->id]) }}" method="get" style="display:inline-block;">     
                    @csrf
                    @method('GET')           
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                  </form>
                 
                  <form action="{{ route('admin_delete_reserva', ['id' => $reserva_pendiente->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-circle-xmark fa-lg" style="color: rgb(255, 255, 255);"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          </div>
        </div>
      </div>




       <div id="reservas_hoy" class="section">
        <h2 class="mb-4">Reservas creadas Hoy</h2>
        <div class="row">
           <div class="card shadow pt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
          
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th>Comensales</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Servicio</th>
                <th>Restricciones</th>
                <th>Niños</th>
                <th>Etiqueta</th>
                <th>Estado</th>                
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              
              @foreach ($reservas_hoy as $reserva_hoy)
                <tr>
                <td>{{$reserva_hoy->name}}</td>
                <td>{{$reserva_hoy->email}}</td>
                <td>{{$reserva_hoy->phone}}</td>
                <td class="text-center">{{$reserva_hoy->guests}}</td>
                <td>{{$reserva_hoy->reservation_date}}</td>
                <td>{{$reserva_hoy->reservation_time}}</td>
                <td>{{$reserva_hoy->service}}</td>
                <td>{{$reserva_hoy->food_description}}</td>
                <td class="text-center" >{{$reserva_hoy->kids_count}}</td>
                <td>{{$reserva_hoy->label}}</td>

                 
                @if ($reserva_hoy->state === 'Pendiente')
                <td ><a class="badge bg-warning  text-dark  p-2">{{$reserva_hoy->state}}</a></td>
                @endif
                @if ($reserva_hoy->state === 'Confirmado')
                <td ><a class="badge bg-success p-2">{{$reserva_hoy->state}}</a></td>
                @endif
                @if ($reserva_hoy->state === 'Cancelado')
                <td ><a class="badge bg-danger p-2">{{$reserva_hoy->state}}</a></td>
                @endif    
                @if ($reserva_hoy->state === 'Atendido')
                <td ><a class="badge bg-primary p-2">{{$reserva_hoy->state}}</a></td>
                @endif  

                 <td>
                  <form action="{{ route('admin_edit_reserva', ['id' => $reserva_hoy->id]) }}" method="get" style="display:inline-block;">     
                    @csrf
                    @method('GET')           
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                  </form>
                  <form action="{{ route('admin_delete_reserva', ['id' => $reserva_hoy->id]) }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-circle-xmark fa-lg" style="color: rgb(255, 255, 255);"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
        
      </div>
      </div>

      <!-- MESAS -->
      <div id="mesas" class="section">
        <h2 class="mb-4">Mesas</h2>
        <div class="row">
          <div class="col-md-3"><div class="card p-3">Mesa 1 (4 personas)</div></div>
          <div class="col-md-3"><div class="card p-3">Mesa 2 (2 personas)</div></div>
        </div>
      </div>

      <!-- HORARIOS -->
      <div id="horarios" class="section">
        <h2 class="mb-4">Horarios</h2>
        <div class="card p-3">
          <p>Lunes - Domingo: 18:00 - 23:00</p>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="reservaModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Reserva</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
       <form action="{{ route('admin_create_reserva') }}" method="post">
          @csrf
          @method('post')
        <input type="hidden" id="editIndex">
        <div class="mb-2"><input class="form-control" id="name" name="name" placeholder="Cliente" required></div>
        <div class="mb-2"><input class="form-control" id="email" name="email" placeholder="E-mail" required></div>
        <div class="mb-2"><input class="form-control" id="phone" name="phone" placeholder="Telefono" required></div>
        <div class="mb-2"><input type="number" min="1" max="100" class="form-control" id="guests" name="guests" placeholder="Personas" required></div>
        <div class="mb-2"><input type="date" class="form-control" id="reservation_date" name="reservation_date" required></div>
        <div class="mb-2"><input type="time" min="11:00" max="22:30" class="form-control" id="reservation_time" name="reservation_time" required></div>
        <div class="mb-2"><select class="form-select"  id="service" name="service" required>
                          <option value="" selected disabled>Seleccione el servicio</option>
                          <option value="Almuerzo">Almuerzo</option>
                          <option value="Cena">Cena</option>                          
                          </select>
        </div>
        <div class="mb-2"><input  class="form-control" id="food_description" name="food_description" placeholder="Restricciones alimentarias" required></div>
        <div class="mb-2"><input type="number" min="0" max="100" class="form-control" id="kids_count" name="kids_count" placeholder="Niños menores de 12 años" required></div>
        
        <div class="mb-2"><select class="form-select"  id="label" name="label" required>
                            <option value="" selected disabled>Seleccione la etiqueta</option>
                            <option value="FITS">FITS</option>
                            <option value="Grupo de agencias">Grupo de agencias</option>
                            <option value="Grupo de guias">Grupo de guias</option>
                            <option value="Invitación">Invitación</option>        
                            <option value="Servicio Regular">Servicio Regular</option>                
                            </select>
          </div>
          <div class="mb-2"><select class="form-select"  id="state" name="state" required>
                           <option value="" selected disabled>Seleccione el estado</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmado">Confirmado</option>                        
                            </select>
          </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-dark" type="submit">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const modal = new bootstrap.Modal(document.getElementById('reservaModal'));
  function openModal(){
  
  /*document.getElementById('cliente').value='';
  document.getElementById('email').value='';
  document.getElementById('telefono').value='';
  document.getElementById('personas').value='';
  document.getElementById('fecha').value='';
  document.getElementById('hora').value='';
  document.getElementById('servicio').value='';
  document.getElementById('restricciones').value='';
  document.getElementById('kids').value='';
  document.getElementById('etiqueta').value='';
  document.getElementById('estado').value='';*/
  modal.show();
}

function showSection(id){
  document.querySelectorAll('.section').forEach(sec => sec.classList.remove('active'));
  document.getElementById(id).classList.add('active');

  document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
  event.target.classList.add('active');
}
</script>


</body>
</html>