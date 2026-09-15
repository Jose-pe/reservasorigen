<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard de Control y Distribución de Mesas</title>
    <!-- Bootstrap 5 CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b0f19;
            color: #f1f5f9;
        }

        /* Colores personalizados compatibles con la paleta original */
        .bg-dark-sidebar { background-color: #030712; }
        .bg-dark-main { background-color: #0b0f19; }
        .bg-dark-card { background-color: #111827; }
        .bg-dark-card-soft { background-color: rgba(17, 24, 39, 0.6); }
        .border-dark-custom { border-color: #1e293b !important; }
        .text-amber { color: #f59e0b; }
        .bg-amber { background-color: #f59e0b; color: #030712; }
        .btn-amber {
            background-color: #f59e0b;
            color: #030712;
            font-weight: 700;
            border: none;
        }
        .btn-amber:hover {
            background-color: #d97706;
            color: #030712;
        }

        /* Patrón de cuadrícula del plano */
        .floorplan-grid {
            background-color: #111827;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            position: relative;
        }

        .table-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5);
        }

        .transition-state {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #111827;
        }
        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* Estados de Mesas */
        .table-disponible {
            background-color: rgba(6, 78, 59, 0.8);
            color: #6ee7b7;
            border-color: rgba(16, 185, 129, 0.5) !important;
        }
        .table-disponible:hover { background-color: #065f46; }

        .table-ocupada {
            background-color: rgba(136, 19, 55, 0.8);
            color: #fda4af;
            border-color: rgba(244, 63, 94, 0.5) !important;
        }
        .table-ocupada:hover { background-color: #9f1239; }

        .table-reservada {
            background-color: rgba(120, 53, 15, 0.8);
            color: #fde047;
            border-color: rgba(245, 158, 11, 0.5) !important;
        }
        .table-reservada:hover { background-color: #92400e; }

        .table-mantenimiento {
            background-color: #1f2937;
            color: #9ca3af;
            border-color: #4b5563 !important;
        }
        .table-mantenimiento:hover { background-color: #374151; }

        .table-selected {
            box-shadow: 0 0 0 4px #f59e0b !important;
            border-color: #f59e0b !important;
            transform: scale(1.05);
        }
         @media(max-width: 1625px) {
        body {
            zoom: 80% !important;
            height: 125vh !important;
        }
        }
    </style>
</head>
<body class="vh-100 d-flex">

    <!-- BARRA LATERAL DE NAVEGACIÓN PRINCIPAL -->
    <aside class="bg-dark-sidebar border-end border-dark-custom d-flex flex-column justify-content-start flex-shrink-0" style="width: 300px;">
        <div>
            <!-- Header de Marca -->
            <div class="p-3 border-bottom border-dark-custom d-flex items-center align-items-center gap-3">
                <div class="rounded-3 bg-amber d-flex align-items-center justify-content-center text-dark font-bold shadow-sm" style="width: 40px; height: 40px; font-size: 1.2rem;">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div>
                    <h1 class="h6 font-bold m-0 text-white fw-bold">Origen</h1>
                    <span class="text-amber font-medium" style="font-size: 0.75rem;">Panel de Control</span>
                </div>
            </div>

            <!-- Enlaces de navegación -->
           
        </div>
       
        
        <div class="d-flex justify-content-center text-center mt-3">
             <h4 class="text-secondary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2" style="font-size: 0.7rem;">
                                <i class="fa-solid fa-calendar text-amber text-center "></i> Reservas para asingnar mesa
                            </h4>
        </div>
        
        <div class="m-1 overflow-auto" id="container-reservas">
            
        </div>

        <!-- Perfil de usuario -->
        
    </aside>

    <!-- CONTENEDOR PRINCIPAL -->
    <main class="flex-grow-1 d-flex flex-column min-w-0 bg-dark-main">
        
        <!-- BARRA SUPERIOR (HEADER) -->
        <header class="border-bottom border-dark-custom px-4 d-flex align-items-center justify-content-between flex-shrink-0" style="height: 64px; background-color: rgba(17, 24, 39, 0.4);">
            <div class="d-flex align-items-center gap-3">
                <h2 class="h5 fw-bold text-white m-0">Gestor de Distribución de Mesas</h2>
                <span class="badge bg-opacity-10 bg-success text-success border border-success border-opacity-25 rounded-pill px-2.5 py-1.5 align-items-center gap-1.5 d-inline-flex">
                    <span class="spinner-grow spinner-grow-sm text-success" style="width: 6px; height: 6px;"></span>
                    Servicio Activo
                </span>
            </div>

            <!-- Acciones de cabecera -->
            <div class="d-flex align-items-center gap-3 p-2">
              

                <div class="text-end small">
                    <div class="fw-semibold text-white" id="current-date">Fecha: </div>
                   {{-- <div class="text-secondary" id="current-time">HORA: {{ \Carbon\Carbon::now()->format('H:i') }}</div>--}}
                   
                    
                </div>
               
                <div class="text-secondary"> <input type="date" class="form-control" id="reservation_date_control" name="reservation_date_control"></div>
                <div class="text-secondary"> <input type="time" class="form-control" id="reservation_time_control" min="11:00" max="22:30" name="reservation_time_control" value="11:00"></div>
                <div class="text-secondary"> <input type="time" disabled class="form-control" id="reservation_time_end_control" name="reservation_time_end_control" value="13:00"></div>
                
                
            </div>
        </header>

        <!-- SUBPANEL DE FILTROS Y CONTROLES -->
        <section class="p-3 border-bottom border-dark-custom d-flex flex-wrap gap-3 align-items-center justify-content-between flex-shrink-0" style="background-color: rgba(17, 24, 39, 0.2);">
            <!-- Pestañas de Zonas -->
            <div class="btn-group p-1 bg-dark-sidebar rounded-3 border border-dark-custom">
                <button onclick="setZone('salon')" id="zone-salon" class="btn btn-sm btn-dark active fw-semibold rounded-2 px-3">
                    <i class="fa-solid fa-couch me-2"></i>Salón Principal
                </button>
                
                <button onclick="setZone('mezaninne')" id="zone-mezaninne" class="btn btn-sm text-secondary fw-semibold rounded-2 px-3">
                    <i class="fa-solid fa-vihara me-2" style="color: rgb(255, 255, 255);"></i>Mezaninne
                </button>
            </div>

            <!-- Buscador y Vista Toggles -->
            <div class="d-flex align-items-center gap-2">
                <select id="filter-status" onchange="filterTables()" class="form-select form-select-sm bg-dark-sidebar border-dark-custom text-light rounded-3 shadow-none" style="width: auto;">
                    <option value="todos">Todos los estados</option>
                    <option value="disponible">Disponible</option>
                    <option value="ocupada">Ocupada</option>
                    <option value="reservada">Reservada</option>
                    {{--<option value="mantenimiento">Mantenimiento</option>--}}
                </select>

                <div class="btn-group p-1 bg-dark-sidebar rounded-3 border border-dark-custom">
                    <button onclick="switchView('map')" id="view-map-btn" class="btn btn-amber btn-sm rounded-2">
                        <i class="fa-solid fa-map"></i>
                    </button>
                    <button onclick="switchView('list')" id="view-list-btn" class="btn btn-sm text-secondary rounded-2">
                        <i class="fa-solid fa-list-ul"></i>
                    </button>
                </div>

                <button type="button" onclick="obtenerReservas()" class="btn btn-amber btn-sm rounded-3 px-3 py-2 d-flex align-items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-bell-concierge" style="color: rgb(16, 16, 16);"></i> Reservas
                </button>
            </div>
        </section>

        <!-- AREA DE CONTENIDO SPLIT: MAPA/LISTA + SIDEBAR -->
        <div class="flex-grow-1 d-flex min-vh-0 position-relative overflow-hidden">
            
            <!-- VISTA MAPA INTERACTIVO -->
            <div id="view-map" class="flex-grow-1 overflow-auto p-4 d-flex align-items-center justify-content-center floorplan-grid user-select-none position-relative">
                
                <div id="floor-container" class="bg-dark-card-soft rounded-4 border border-dark-custom position-relative overflow-hidden shadow-lg" style="width: 1150px; height: 550px;">
                    
                  

                    <div id="visual-decor-kitchen-1" class="position-absolute bg-dark-sidebar border-top border-start border-end border-dark-custom d-flex align-items-center justify-content-center rounded-top-3 text-secondary fw-bold" style="left: 93%; top:15%; width: 5%; height: 65%; font-size: 12px; letter-spacing: 1px;">
                       Bar
                    </div>
                   <div id="visual-decor-kitchen-2" class="position-absolute bg-dark-sidebar border-top border-start border-end border-dark-custom d-flex align-items-center justify-content-center rounded-top-3 text-secondary fw-bold" style="left: 40%; right:40%; bottom: 1%; width: 40%; height: 55px; font-size: 12px; letter-spacing: 1px;">
                        Bar
                    </div>

                    <div id="interactive-map" class="position-absolute inset-0 w-100 h-100">
                        
                    </div>
                </div>
            </div>

            <!-- VISTA EN TABLA/LISTA -->
            <div id="view-list" class="flex-grow-1 overflow-y-auto p-4 d-none">
                <div class="max-w-4xl mx-auto bg-dark-card rounded-4 border border-dark-custom overflow-hidden shadow">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead class="bg-dark-sidebar border-bottom border-dark-custom text-secondary text-uppercase" style="font-size: 0.75rem;">
                            <tr>
                                <th class="py-3 px-4">Mesa</th>
                                <th class="py-3 px-4">Zona</th>
                                <th class="py-3 px-4">Capacidad</th>
                                <th class="py-3 px-4">Forma</th>
                                <th class="py-3 px-4">Estado Actual</th>
                                <th class="py-3 px-4 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="list-tables-body" class="border-top-0 small">
                            <!-- Dinámico -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PANEL LATERAL DERECHO (Detalles) -->
            <aside class="bg-dark-sidebar border-start border-dark-custom d-flex flex-column justify-content-between flex-shrink-0 overflow-y-auto" style="width: 360px;">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-dark-custom pb-3 mb-4">
                        <div>
                            <h3 class="fw-bold text-white h6 m-0">Configuración de Mesa</h3>
                           
                        </div>
                        <span class="badge bg-dark border border-dark-custom text-secondary">ID MESA:<span id="id_mesa"></span></span>
                    </div>

                    <div id="empty-state-sidebar" class="py-5 text-center">
                        <div class="rounded-circle bg-dark-card d-flex align-items-center justify-content-center text-secondary mx-auto mb-3 border border-dark-custom" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-hand-pointer fs-4"></i>
                        </div>
                        <p class="small text-secondary px-4 m-0">Selecciona una mesa en el plano para editar sus propiedades.</p>
                    </div>

                    <div id="editor-form-sidebar" class="d-none">
                       {{-- <div class="row g-3 mb-4">
                            <div class="col-6">
                                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.65rem;">Etiqueta/No.</label>
                                <input type="text" id="edit-table-number" oninput="saveLiveChanges()" class="form-control bg-dark-card border-dark-custom text-white fw-bold shadow-none">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.65rem;">Comensales Máx.</label>
                                <div class="input-group bg-dark-card border border-dark-custom rounded-3 overflow-hidden">
                                    <button onclick="adjustCapacity(-1)" class="btn btn-sm btn-dark text-secondary border-0"><i class="fa-solid fa-minus text-xs"></i></button>
                                    <input type="number" id="edit-table-capacity" min="1" max="12" readonly class="form-control form-control-sm bg-transparent border-0 text-center text-white fw-bold shadow-none">
                                    <button onclick="adjustCapacity(1)" class="btn btn-sm btn-dark text-secondary border-0"><i class="fa-solid fa-plus text-xs"></i></button>
                                </div>
                            </div>
                        </div>--}}

                        <div class="mb-4">
                            <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.65rem;">Estado de la Mesa</label>
                            <div class="row g-2" id="status-button-group">
                                <div class="col-6">
                                    <button onclick="setTableStatus('disponible')" id="status-btn-disponible" class="btn btn-outline-secondary w-100 btn-sm text-start p-2 d-flex align-items-center gap-2">
                                        <span class="rounded-circle bg-success d-inline-block" style="width: 8px; height: 8px;"></span>
                                        Disponible
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button onclick="setTableStatus('ocupada')" id="status-btn-ocupada" class="btn btn-outline-secondary w-100 btn-sm text-start p-2 d-flex align-items-center gap-2">
                                        <span class="rounded-circle bg-danger d-inline-block" style="width: 8px; height: 8px;"></span>
                                        Ocupada
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button onclick="setTableStatus('reservada')" id="status-btn-reservada" class="btn btn-outline-secondary w-100 btn-sm text-start p-2 d-flex align-items-center gap-2">
                                        <span class="rounded-circle bg-warning d-inline-block" style="width: 8px; height: 8px;"></span>
                                        Reservada
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button onclick="setTableStatus('mantenimiento')" id="status-btn-mantenimiento" class="btn btn-outline-secondary w-100 btn-sm text-start p-2 d-flex align-items-center gap-2">
                                        <span class="rounded-circle bg-secondary d-inline-block" style="width: 8px; height: 8px;"></span>
                                        Bloqueada
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                               {{-- <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.65rem;">Forma</label>
                                <div class="btn-group w-100 p-1 bg-dark-card rounded-3 border border-dark-custom">
                                    <button onclick="setTableShape('square')" id="shape-btn-square" class="btn btn-sm btn-dark fw-semibold text-xs">Cuadrada</button>
                                    <button onclick="setTableShape('round')" id="shape-btn-round" class="btn btn-sm text-secondary fw-semibold text-xs">Redonda</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.65rem;">Sala / Zona</label>
                                <select id="edit-table-zone" onchange="saveLiveChanges()" class="form-select form-select-sm bg-dark-card border-dark-custom text-white shadow-none">
                                    <option value="salon">Salón Principal</option>
                                    <option value="terraza">Terraza Exterior</option>
                                    
                                </select>--}}
                            </div>
                        </div>

                        <div class="border-top border-dark-custom pt-4">
                            <h4 class="text-secondary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2" style="font-size: 0.7rem;">
                                <i class="fa-solid fa-calendar text-amber"></i> Mesa Asignada:
                            </h4>
                       
                            <div class= "card text-white bg-dark mb-3 d-flex flex-column justify-content-center" style="max-width: 22rem;" id="sidebar-reservation-list">
                                   <div class="d-flex align-items-center justify-content-between mb-3 p-2">
        <h6 class="text-white m-0 p-2">ID: RESERVA <span id="id_mesa"></span></h6>
        <span id="reserva_id_lbl" class="badge bg-amber text-dark fw-bold p-2"></span>
        </div>
                                <h6 id="reserva_cliente_name" class="text-amber fw-bold mb-2 p-2">Nombre Cliente</h6>
        
        <div class="text-white small mb-1 p-2">
            <i class="fa-regular fa-calendar me-1"></i>
            <span id="reserva_date_lbl">YYYY-MM-DD</span>
        </div>
        
        <div class="text-white small mb-1 p-2">
            <i class="fa-regular fa-clock me-1"></i>
            <span id="reserva_horario_lbl">00:00 - 00:00</span>
        </div>

        <div class="text-white small mb-1 p-2">
            <i class="fa-solid fa-users me-1"></i>
            <span id="reserva_pax_lbl">Comensales: 0</span>
        </div>

        <div class="d-flex gap-2 mt-2 p-2">
          
            <span  class="badge bg-warning text-dark p-2">  <i class="fa-solid fa-utensils me-2" style="color: rgb(5, 5, 5);"></i> <span id="reserva_servicio_lbl"> Servicio </span></span>
            
        </div>
        <hr>
          <div class="d-flex gap-2 mt-2 p-2">
           <button id="btn-quitar-asignacion" type="button"  class="btn btn-danger btn-sm"><i class="fa-solid fa-rotate-left fa-sm pe-2" style="color: rgb(255, 255, 255);"></i>Quitar Asignación</button>
           <button id="btn-atendido" onclick="mesas_atendido()" type="button" class="btn btn-warning btn-sm"><i class="fa-solid fa-square-check fa-sm pe-2" style="color: rgb(0, 0, 0);"></i>Atendido</button>
        </div>                     
                
              
                            </div>
                        </div>
                    </div>
                </div>
              
               
              
               {{-- <div class="p-4 border-top border-dark-custom bg-dark-sidebar sticky-bottom">
                    <button onclick="deleteSelectedTable()" id="btn-delete-table" class="btn btn-outline-danger w-100 fw-bold py-2 ">
                        <i class="fa-solid fa-trash-can me-2"></i>Eliminar Mesa
                    </button>
                </div>--}}
            </aside>
        </div> 

        <!-- FOOTER KPIS -->
        <footer class="border-top border-dark-custom px-4 d-flex align-items-center justify-content-between flex-shrink-0 bg-dark-sidebar" style="height: 56px; font-size: 0.75rem;">
            <div class="d-flex align-items-center gap-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle bg-success d-inline-block" style="width: 8px; height: 8px;"></span>
                    <span class="text-secondary">Disponible (<span id="lbl-count-disponibles">0</span>)</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle bg-danger d-inline-block" style="width: 8px; height: 8px;"></span>
                    <span class="text-secondary">Ocupada (<span id="lbl-count-ocupadas">0</span>)</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle bg-warning d-inline-block" style="width: 8px; height: 8px;"></span>
                    <span class="text-secondary">Reservada (<span id="lbl-count-reservadas">0</span>)</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle bg-secondary d-inline-block" style="width: 8px; height: 8px;"></span>
                    <span class="text-secondary">Bloqueada (<span id="lbl-count-mantenimiento">0</span>)</span>
                </div>
            </div>

            <div class="d-flex gap-4 align-items-center">
                <div>
                    <span class="text-secondary text-uppercase">Capacidad Total:</span>
                    <span class="text-white fw-bold ms-1" id="lbl-total-seats">0 pax</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase">Ocupación:</span>
                    <span class="text-amber fw-bold ms-1" id="lbl-occupancy-rate">0%</span>
                </div>
            </div>
        </footer>

    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/js-mesas/mesas.js"></script>
   
</body>
</html>