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
      <a  href="{{route('admin_reclamos_index')}}"><i class="fa-brands fa-leanpub fa-lg" style="color: rgb(255, 255, 255);"></i> Quejas y Reclamos </a>
      <a class="active" href="#"><i class="fa-solid fa-chart-simple fa-lg" style="color: rgb(255, 255, 255);"></i> Estadisticas </a>
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
<!-- Filtros de Búsqueda -->

    <div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Estadísticas de Reservas
            </h2>

            <p class="text-muted mb-0">
                Reservas atendidas y canceladas - {{ $year }}
            </p>
        </div>

        <form method="GET"
              action="{{ route('admin_estadisticas_reservas') }}">

            <select name="year"
                    class="form-select"
                    onchange="this.form.submit()">

                @for($i = now()->year; $i >= now()->year - 5; $i--)

                    <option value="{{ $i }}"
                        {{ $year == $i ? 'selected' : '' }}>

                        {{ $i }}

                    </option>

                @endfor

            </select>

        </form>

    </div>


    {{-- GRÁFICO --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">
                Reservas atendidas vs canceladas
            </h5>

        </div>

        <div class="card-body">

            <div style="height: 450px;">

                <canvas id="reservasEstadoChart"></canvas>

            </div>

        </div>

    </div>


      <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">
                Total de reservas al mes
            </h5>

        </div>

        <div class="card-body">

            <div style="height: 450px;">

                <canvas id="reservasMesChart"></canvas>

            </div>

        </div>

    </div>


    <div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white border-0 py-3">

        <h5 class="fw-bold mb-0">
            Reservas realizadas desde la Web
        </h5>

        <small class="text-muted">
            Reservas con etiqueta "Reserva Web"
        </small>

    </div>

    <div class="card-body">

        <div style="height: 400px;">

            <canvas id="reservasWebChart"></canvas>

        </div>

    </div>

</div>

</div>


    
      
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const estadisticas = @json($estadisticas);


    /*
    |--------------------------------------------------------------------------
    | LABELS
    |--------------------------------------------------------------------------
    */

    const meses = estadisticas.map(item => item.mes);


    /*
    |--------------------------------------------------------------------------
    | ATENDIDAS
    |--------------------------------------------------------------------------
    */

    const atendido = estadisticas.map(item => item.atendido);


    /*
    |--------------------------------------------------------------------------
    | CANCELADAS
    |--------------------------------------------------------------------------
    */

    const cancelado = estadisticas.map(item => item.cancelado);


    /*
    |--------------------------------------------------------------------------
    | CHART
    |--------------------------------------------------------------------------
    */

    const ctx = document
        .getElementById('reservasEstadoChart');


    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: meses,

            datasets: [

                {
                    label: 'Atendido',

                    data: atendido,

                    backgroundColor: 'rgba(25, 135, 84, 0.75)',

                    borderColor: 'rgba(25, 135, 84, 1)',

                    borderWidth: 1,

                    borderRadius: 6,

                    maxBarThickness: 50
                },

                {
                    label: 'Cancelado',

                    data: cancelado,

                    backgroundColor: 'rgba(220, 53, 69, 0.75)',

                    borderColor: 'rgba(220, 53, 69, 1)',

                    borderWidth: 1,

                    borderRadius: 6,

                    maxBarThickness: 50
                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false
            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    },

                    title: {
                        display: true,
                        text: 'Cantidad de reservas'
                    }

                },

                x: {

                    title: {
                        display: true,
                        text: 'Mes'
                    }

                }

            },

            plugins: {

                legend: {

                    position: 'top'

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' ' +
                                context.dataset.label +
                                ': ' +
                                context.parsed.y +
                                ' reservas';

                        }

                    }

                }

            }

        }

    });


     /*
    |--------------------------------------------------------------------------
    | 1. RESERVAS POR MES
    |--------------------------------------------------------------------------
    */
     let estadisticasMeses = @json($estadisticasMeses);
    const mesesLabels = estadisticasMeses.map(item => item.mes);

    const mesesData = estadisticasMeses.map(item => item.total);


    new Chart(
        document.getElementById('reservasMesChart'),
        {

            type: 'bar',

            data: {

                labels: mesesLabels,

                datasets: [

                    {
                        label: 'Reservas',

                        data: mesesData,

                        backgroundColor: 'rgba(13, 110, 253, 0.75)',

                        borderColor: 'rgba(13, 110, 253, 1)',

                        borderWidth: 1,

                        borderRadius: 6,

                        maxBarThickness: 60
                    }

                ]
            },


            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        title: {

                            display: true,

                            text: 'Cantidad de reservas'

                        }

                    }

                },

                plugins: {

                    legend: {

                        display: true

                    }

                }

            }

        }
    );

 const estadisticasWeb = @json($estadisticasWeb);

    const mesesWeb = estadisticasWeb.map(item => item.mes);

    const reservasWeb = estadisticasWeb.map(item => item.total);


    new Chart(
        document.getElementById('reservasWebChart'),
        {

            type: 'bar',

            data: {

                labels: mesesWeb,

                datasets: [

                    {
                        label: 'Reservas Web',

                        data: reservasWeb,

                        backgroundColor: 'rgba(13, 110, 253, 0.75)',

                        borderColor: 'rgba(13, 110, 253, 1)',

                        borderWidth: 1,

                        borderRadius: 6,

                        maxBarThickness: 60
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        title: {

                            display: true,

                            text: 'Cantidad de reservas'

                        }

                    },

                    x: {

                        title: {

                            display: true,

                            text: 'Mes'

                        }

                    }

                },

                plugins: {

                    legend: {

                        display: true

                    },

                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                return ' ' +
                                    context.parsed.y +
                                    ' reservas';

                            }

                        }

                    }

                }

            }

        }
    );


</script>
</body>
</html>