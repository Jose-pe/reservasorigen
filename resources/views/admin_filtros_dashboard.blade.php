<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel Administrador - Reservas - Filtros</title>
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
      <a class="active" href="#"><i class="fa-solid fa-filter fa-lg" style="color: rgb(255, 255, 255);"></i> Más filtros</a>
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
           <div class="col-4 text-start m-3">
            
            <form action="{{route('admin_filtrar_email')}}" method="get">
                 @csrf
                @method('GET')
            <div class="input-group mb-3">
            <span class="input-group-text fw-bolder">Filtrar por e-mail</span>
            <input type="email" class="form-control fw-bolder" id="email" name="email" required>
            <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
            </form>
        </div>
        <div class="col-4 text-start m-3">
           <form action="{{route('admin_filtrar_fecha')}}" method="get">
             @csrf
             @method('GET')
            <div class="input-group mb-3">
            <span class="input-group-text fw-bolder">Filtrar por fecha</span>
            <input type="date" class="form-control fw-bolder" id="reservation_date" name="reservation_date" required>
            <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
            </form>

        </div>
        <div class="col-4 d-flex justify-content-start m-3">
         <form action="{{route('admin_filtrar_etiqueta')}}" method="get">
                @csrf
                @method('GET')
             <div class="input-group mb-3">
             <span class="input-group-text fw-bolder">Filtrar por etiqueta</span>
             <select class="form-control" id="label" name="label" required>
             <option value="" selected disabled>Seleccione la etiqueta</option>
                            <option value="FITS">FITS</option>
                            <option value="Grupo de agencias">Grupo de agencias</option>
                            <option value="Grupo de guias">Grupo de guias</option>
                            <option value="Invitación">Invitación</option>        
                            <option value="Servicio Regular">Servicio Regular</option>  
                            <option value="Reserva web">Reserva Web</option>              
                            </select>
            <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
            </form>

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
                <th>Ocación</th>
                <th>Estado de Pago</th>
                <th>Etiqueta</th>
                <th>Estado</th>   
                <th>Observasiones</th>             
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
                <td class="text-center" >{{$reserva->special_time}}</td>
                 @if ($reserva->pay_state === 'IMPAGO')
                <td class="text-center" ><a class="badge bg-danger text-white  p-2">{{$reserva->pay_state}}</a></td>
                @endif
                @if ($reserva->pay_state === 'PAGO')
                <td class="text-center" ><a class="badge  bg-success p-2">{{$reserva->pay_state}}</a></td>
                @endif
                 @if ($reserva->pay_state === 'NO APLICA')
                <td class="text-center" ><a class="badge text-dark bg-warning p-2">{{$reserva->pay_state}}</a></td>
                @endif
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
                @if ($reserva->state === 'Atendido')
                <td ><a class="badge bg-primary p-2">{{$reserva->state}}</a></td>
                @endif
               
                    <td>{{$reserva->observation}}</td>
                
                <td>  
                    <form action="{{ route('admin_edit_reserva', ['id' => $reserva->id]) }}" method="GET" style="display:inline-block;">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>

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
        

       
        
      </div>

      <!-- RESERVAS -->
      
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>