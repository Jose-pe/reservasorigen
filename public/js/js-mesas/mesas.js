// MESAS SALON PRINCIPAL 
let tables = [];
let selectedTableId = null;
let activeZone = "salon";
let activeView = "map";
let activeShift = "almuerzo";
let draggingElement = null;
let dragOffset = { x: 0, y: 0 };
 const today = new Date().toISOString().split('T')[0];
 document.getElementById('reservation_date_control').value = today;


 const inputInicio = document.getElementById('reservation_time_control');
 const inputFin = document.getElementById('reservation_time_end_control');

        // Escucha cada vez que el usuario modifica el primer input
        inputInicio.addEventListener('input', () => {
            if (!inputInicio.value) return; // Si se borra la hora, no hace nada

            // Separamos las horas y los minutos del primer input
            let [horas, minutos] = inputInicio.value.split(':').map(Number);

            // Sumamos las 2 horas requeridas
            horas += 2;

            // Ajustamos si la suma excede las 24 horas del día (ej. de 23:00 pasa a 01:00)
            if (horas >= 24) {
                horas = horas - 24;
            }

            // Formateamos para que siempre tengan dos dígitos (ej. "9" se convierte en "09")
            const horasFormateadas = String(horas).padStart(2, '0');
            const minutosFormateados = String(minutos).padStart(2, '0');

            // Asignamos el nuevo valor al segundo input
            inputFin.value = `${horasFormateadas}:${minutosFormateados}`;
        });
    


// 1. Obtener mesas filtradas por Fecha y Hora
async function getTables() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Obtenemos los valores de fecha y hora de la interfaz
    const fechaInput = document.getElementById('reservation_date_control') || document.getElementById('reservation_date');
    const horaInput = document.getElementById('reservation_time_control') || document.getElementById('reservation_time');
    
    let fecha = fechaInput ? fechaInput.value : '';
    let hora = horaInput ? horaInput.value : '';

    if (hora && hora.length === 5) {
        hora += ':00';
    }

    try {
        // Construimos la URL enviando la fecha y la hora si existen
        let url = '/listar_mesas';
        const params = new URLSearchParams();
        if (fecha) params.append('fecha', fecha);
        if (hora) params.append('hora', hora);
        if (params.toString()) url += `?${params.toString()}`;

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        if (!response.ok) {
            throw new Error(`Error HTTP! Estado: ${response.status}`);
        }

        const data = await response.json();
        
        // Mapeamos el resultado: Si el backend indica que está ocupada por traslape de 2 horas, asignamos el estado dinámico
        tables = data.map(item => {
            let estadoCalculado = item.status || 'disponible';
            if (item.is_occupied) {
                estadoCalculado = 'ocupada';
            }
            return {
                ...item,
                status: estadoCalculado
            };
        });

        console.log('Mesas cargadas correctamente:', tables);
        
        renderActiveView();
        updateDailyKPIs();

    } catch (error) {
        console.error('Error al obtener las mesas:', error);
    }
}

// 2. Listener de cambio de fecha y hora para recargar mesas automáticamente
const fechaSeleccionada = document.getElementById('reservation_date_control') || document.getElementById('reservation_date');
if (fechaSeleccionada) {
    fechaSeleccionada.addEventListener('change', () => {
        getTables();
    });
}

const horaSeleccionada = document.getElementById('reservation_time_control') || document.getElementById('reservation_time');
if (horaSeleccionada) {
    horaSeleccionada.addEventListener('change', () => {
        getTables();
    });
}

async function storeTables() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    for (const table of tables) {
        try {
            const response = await fetch('/guardar_mesas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(table)
            });

            if (!response.ok) {
                throw new Error(`Error en la petición: ${response.statusText}`);
            }

            const data = await response.json();
            console.log(`Mesa ${table.number} guardada con éxito:`, data);

        } catch (error) {
            console.error(`Error guardando la mesa ${table.number}:`, error);
        }
    }
    
    console.log("¡Proceso completado!");
}

// Configuración de fecha mínima (Hoy)
const hoy = new Date();
const anio = hoy.getFullYear();
const mes = String(hoy.getMonth() + 1).padStart(2, '0'); 
const dia = String(hoy.getDate()).padStart(2, '0');
const fechaMinima = `${anio}-${mes}-${dia}`;

const inputResDate = document.getElementById('reservation_date');
if (inputResDate) {
    inputResDate.min = fechaMinima;
    if (!inputResDate.value) inputResDate.value = fechaMinima;
}

window.addEventListener('DOMContentLoaded', () => {
    getTables();
});

function setZone(zoneName) {
    activeZone = zoneName; 
     
    ['salon','mezaninne'].forEach(z => {
        const btn = document.getElementById(`zone-${z}`);
        if (btn) {
            if (z === zoneName) {
                btn.className = "btn btn-sm btn-dark active fw-semibold rounded-2 px-3";
            } else {
                btn.className = "btn btn-sm text-secondary fw-semibold rounded-2 px-3";
            }
        } 
    }); 
    deselectTable();
    renderActiveView();   
     updateDailyKPIs();       
} 

function switchView(viewName) {
    activeView = viewName;
    const mapBtn = document.getElementById('view-map-btn');
    const listBtn = document.getElementById('view-list-btn');
    const mapView = document.getElementById('view-map');
    const listView = document.getElementById('view-list');

    if (viewName === 'map') {
        if (mapBtn) mapBtn.className = "btn btn-amber btn-sm rounded-2";
        if (listBtn) listBtn.className = "btn btn-sm text-secondary rounded-2";
        if (mapView) mapView.classList.remove('d-none');
        if (listView) listView.classList.add('d-none');
    } else {
        if (listBtn) listBtn.className = "btn btn-amber btn-sm rounded-2";
        if (mapBtn) mapBtn.className = "btn btn-sm text-secondary rounded-2";
        if (listView) listView.classList.remove('d-none');
        if (mapView) mapView.classList.add('d-none');
    }
    renderActiveView();
}

function renderActiveView() {
    if (activeView === 'map') {
        renderFloorplan();
    } else {
        renderTableList();
    }
}

function renderFloorplan() {
    const container = document.getElementById('interactive-map');
    if (!container) return;
    container.innerHTML = '';

    const zoneTables = tables.filter(t => t.zone === activeZone);
    
    if (activeZone === 'mezaninne') {
        document.getElementById('visual-decor-bar-1')?.classList.add('d-none');
        document.getElementById('visual-decor-bar-2')?.classList.add('d-none');
        document.getElementById('visual-decor-bar-3')?.classList.add('d-none');
        document.getElementById('visual-decor-kitchen-1')?.classList.add('d-none');
        document.getElementById('visual-decor-kitchen-2')?.classList.add('d-none');
        document.getElementById('visual-divisor-1')?.classList.remove('d-none');
        document.getElementById('visual-divisor-2')?.classList.remove('d-none');
    } else if (activeZone === 'salon') {
        document.getElementById('visual-decor-bar-1')?.classList.remove('d-none');
        document.getElementById('visual-decor-bar-2')?.classList.remove('d-none');
        document.getElementById('visual-decor-bar-3')?.classList.remove('d-none');
        document.getElementById('visual-decor-kitchen-1')?.classList.remove('d-none');
        document.getElementById('visual-decor-kitchen-2')?.classList.remove('d-none');
        document.getElementById('visual-divisor-1')?.classList.add('d-none');
        document.getElementById('visual-divisor-2')?.classList.add('d-none');
    }

    zoneTables.forEach(table => {
        const tableEl = document.createElement('div');
        tableEl.id = `map-table-${table.id}`;
        tableEl.style.position = 'absolute';
        tableEl.style.cursor = 'grab';
        tableEl.className = `table-shadow transition-state d-flex flex-column align-items-center justify-content-center p-2 border border-2 user-select-none `;

        if (table.shape === 'round') {
            tableEl.classList.add('rounded-circle');
        } else {
            tableEl.classList.add('rounded-4');
        }

        let sizeStyle = { width: '100px', height: '80px', fontSize: '0.75rem' };
        if (table.capacity === 1) {
            sizeStyle = { width: '50px', height: '50px', fontSize: '0.7rem' };
        }else if (table.capacity === 2) {
            sizeStyle = { width: '120px', height: '65px', fontSize: '0.7rem' };
        }else if (table.capacity === 4) {
            sizeStyle = { width: '130px', height: '100px', fontSize: '0.85rem' };
        } else if (table.capacity === 6) {
            sizeStyle = { width: '190px', height: '125px', fontSize: '0.85rem' };
        } else if (table.capacity === 7) {
            sizeStyle = { width: '150px', height: '110px', fontSize: '1rem' };
        } else if (table.capacity === 12) {
            sizeStyle = { width: '100px', height: '350px', fontSize: '1rem' };
        }
        
        Object.assign(tableEl.style, sizeStyle);
        tableEl.classList.add(`table-${table.status}`);

        if (table.id === selectedTableId) {
            tableEl.classList.add('table-selected');
        }

        tableEl.style.left = `${table.x}px`;
        tableEl.style.top = `${table.y}px`;

        let chairsHTML = '';
        for(let i=1; i<=table.capacity; i++) {
            chairsHTML += `<span class="d-inline-block rounded-circle bg-current opacity-75 mx-0.5" style="width: 5px; height: 5px;"></span>`;
        }

        tableEl.innerHTML = `
            <div class="fw-bold text-white mb-1 leading-none">${table.number}</div>
            <div class="fw-semibold opacity-75 mb-1" style="font-size: 9px;">${table.capacity} Pax</div>
            <div class="d-flex align-items-center justify-content-center">${chairsHTML}</div>
        `;

        tableEl.addEventListener('click', (e) => {
            e.stopPropagation();
            selectTable(table.id);
        });

        tableEl.addEventListener('mousedown', (e) => {
            if (e.button !== 0) return;
            draggingElement = table;
            const rect = tableEl.getBoundingClientRect();
            dragOffset.x = e.clientX - rect.left;
            dragOffset.y = e.clientY - rect.top;
            tableEl.classList.remove('transition-state');
            tableEl.style.cursor = 'grabbing';
        });

        container.appendChild(tableEl);
    });
}

document.addEventListener('mousemove', (e) => {
    if (!draggingElement) return;

    const floorContainer = document.getElementById('floor-container');
    if (!floorContainer) return;
    const containerRect = floorContainer.getBoundingClientRect();
    
    let newX = e.clientX - containerRect.left - dragOffset.x;
    let newY = e.clientY - containerRect.top - dragOffset.y;

    const tableEl = document.getElementById(`map-table-${draggingElement.id}`);
    if (!tableEl) return;

    const tableWidth = tableEl.offsetWidth;
    const tableHeight = tableEl.offsetHeight;

    newX = Math.max(0, Math.min(newX, containerRect.width - tableWidth));
    newY = Math.max(0, Math.min(newY, containerRect.height - tableHeight));

    newX = Math.round(newX / 10) * 10;
    newY = Math.round(newY / 10) * 10;

    draggingElement.x = newX;
    draggingElement.y = newY;

    tableEl.style.left = `${newX}px`;
    tableEl.style.top = `${newY}px`;
});

document.addEventListener('mouseup', () => {
    if (draggingElement) {
        const tableEl = document.getElementById(`map-table-${draggingElement.id}`);
        if (tableEl) {
            tableEl.classList.add('transition-state');
            tableEl.style.cursor = 'grab';
        }
        draggingElement = null;
    }
});

function filterTables() {
    renderActiveView();
}

function renderTableList() {
    const tbody = document.getElementById('list-tables-body');
    if (!tbody) return;
    tbody.innerHTML = '';

    const statusFilter = document.getElementById('filter-status')?.value || 'todos';
    let filtered = tables.filter(t => t.zone === activeZone);
    
    if (statusFilter !== 'todos') {
        filtered = filtered.filter(t => t.status === statusFilter);
    }

    if (filtered.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="py-5 text-center text-secondary">
                    <i class="fa-solid fa-triangle-exclamation fs-3 mb-2 d-block"></i>
                    No se encontraron mesas que coincidan con los filtros.
                </td>
            </tr>
        `;
        return;
    }

    filtered.forEach(table => {
        let statusBadge = "";
        if (table.status === 'disponible') {
            statusBadge = `<span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill"><span class="d-inline-block rounded-circle bg-success me-1" style="width:6px;height:6px;"></span>Disponible</span>`;
        } else if (table.status === 'ocupada') {
            statusBadge = `<span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill"><span class="d-inline-block rounded-circle bg-danger me-1" style="width:6px;height:6px;"></span>Ocupada</span>`;
        } else if (table.status === 'reservada') {
            statusBadge = `<span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill"><span class="d-inline-block rounded-circle bg-warning me-1" style="width:6px;height:6px;"></span>Reservada</span>`;
        } else {
            statusBadge = `<span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill"><span class="d-inline-block rounded-circle bg-secondary me-1" style="width:6px;height:6px;"></span>Bloqueada</span>`;
        }

        const isSelected = table.id === selectedTableId;
        const tr = document.createElement('tr');
        tr.className = isSelected ? "table-active text-white" : "";
        tr.style.cursor = "pointer";
        tr.onclick = () => selectTable(table.id);
        tr.innerHTML = `
            <td class="py-3 px-4 fw-bold text-white">${table.number}</td>
            <td class="py-3 px-4 text-capitalize">${table.zone}</td>
            <td class="py-3 px-4 fw-semibold">${table.capacity} pax</td>
            <td class="py-3 px-4 text-capitalize">${table.shape === 'round' ? 'Redonda' : 'Cuadrada'}</td>
            <td class="py-3 px-4">${statusBadge}</td>
            <td class="py-3 px-4 text-end">
                <button onclick="selectTable(${table.id})" class="btn btn-sm btn-link text-secondary p-0">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function selectTable(id) {
    selectedTableId = id;
    const table = tables.find(t => t.id === id);
    if (!table) return;

    renderActiveView();
    //const lblIdMesa = document.getElementById('id_mesa');
    //if (lblIdMesa) lblIdMesa.innerText = `${table.id}`;
    
    //document.getElementById('empty-state-sidebar')?.classList.add('d-none');
    //document.getElementById('editor-form-sidebar')?.classList.remove('d-none');

    //(table.status);
    // Actualizar identificador de la mesa en el sidebar
    const lblIdMesa = document.getElementById('id_mesa');
    if (lblIdMesa) lblIdMesa.innerText = `${table.id}`;

    // Mostramos los contenedores correspondientes del sidebar
    document.getElementById('empty-state-sidebar')?.classList.add('d-none');
    document.getElementById('editor-form-sidebar')?.classList.remove('d-none');

    // Recuperar contenedor de detalles de reserva si existe
    const reservaContainer = document.getElementById('sidebar-reservation-list');

    if (table.reserva_info) {
        const r = table.reserva_info;

        // Formatear horas de HH:MM:SS a HH:MM
        const horaInicio = r.reservation_time ? r.reservation_time.substring(0, 5) : '--:--';
        const horaFin = r.reservation_out ? r.reservation_out.substring(0, 5) : '--:--';

        // Actualizar datos del comensal y reserva en la interfaz
        if (document.getElementById('reserva_cliente_name')) {
            document.getElementById('reserva_cliente_name').innerText = r.name || 'Sin nombre';
        }
        if (document.getElementById('reserva_id_lbl')) {
            document.getElementById('reserva_id_lbl').innerText = `${r.id_reserva}`;
        }
        if (document.getElementById('reserva_date_lbl')) {
            document.getElementById('reserva_date_lbl').innerText = r.reservation_date;
        }
        if (document.getElementById('reserva_horario_lbl')) {
            document.getElementById('reserva_horario_lbl').innerText = `${horaInicio} - ${horaFin}`;
        }
        if (document.getElementById('reserva_pax_lbl')) {
            document.getElementById('reserva_pax_lbl').innerText = `Comensales: ${r.comensales} | Niños: ${r.ninos}`;
        }
        if (document.getElementById('reserva_servicio_lbl')) {
            document.getElementById('reserva_servicio_lbl').innerText = r.service || 'General';
        }
        if (document.getElementById('reserva_estado_atencion')) {
            document.getElementById('reserva_estado_atencion').innerText = r.state_atention;
        }

        if (reservaContainer) reservaContainer.classList.remove('d-none');
    } else {
        // Limpiar información si la mesa está disponible / sin reserva
        if (reservaContainer) reservaContainer.classList.add('d-none');
        
        if (document.getElementById('reserva_cliente_name')) {
            document.getElementById('reserva_cliente_name').innerText = 'Mesa Disponible';
        }
    }
    
    updateStatusButtonsInSidebar(table.status);
}

function deselectTable() {
    selectedTableId = null;
    document.getElementById('empty-state-sidebar')?.classList.remove('d-none');
    document.getElementById('editor-form-sidebar')?.classList.add('d-none');
    const lblIdMesa = document.getElementById('id_mesa');
    if (lblIdMesa) lblIdMesa.innerHTML = '';
    renderActiveView();
}

function setTableStatus(status) {
    if (!selectedTableId) return;
    const table = tables.find(t => t.id === selectedTableId);
    if (table) {
        table.status = status;
        updateStatusButtonsInSidebar(status);
        renderActiveView();
        updateDailyKPIs();
        selectTable(selectedTableId);
    }
}

function updateStatusButtonsInSidebar(status) {
    const btns = {
        disponible: document.getElementById('status-btn-disponible'),
        ocupada: document.getElementById('status-btn-ocupada'),
        reservada: document.getElementById('status-btn-reservada'),
        mantenimiento: document.getElementById('status-btn-mantenimiento')
    };

    Object.keys(btns).forEach(key => {
        if (btns[key]) {
            if (key === status) {
                let activeClass = "btn-dark border-light text-white";
                if (key === 'disponible') activeClass = "btn-outline-success active";
                if (key === 'ocupada') activeClass = "btn-outline-danger active";
                if (key === 'reservada') activeClass = "btn-outline-warning active";
                if (key === 'mantenimiento') activeClass = "btn-outline-secondary active";
                btns[key].className = `btn w-100 btn-sm text-start p-2 d-flex align-items-center gap-2 ${activeClass}`;
            } else {
                btns[key].className = "btn btn-outline-secondary w-100 btn-sm text-start p-2 d-flex align-items-center gap-2 text-secondary";
            }
        }
    });
}

function setTableShape(shape) {
    if (!selectedTableId) return;
    const table = tables.find(t => t.id === selectedTableId);
    if (table) {
        table.shape = shape;
        renderActiveView();
    }
}

function addNewTable() {
    const nextId = tables.length > 0 ? Math.max(...tables.map(t => t.id)) + 1 : 1;
    let letter = "M";

    const newTable = {
        id: nextId,
        number: `${letter}${nextId}`,
        capacity: activeZone === 'barra' ? 1 : 4,
        shape: activeZone === 'barra' ? "round" : "square",
        status: "disponible",
        zone: activeZone,
        x: 150 + (Math.random() * 80),
        y: 150 + (Math.random() * 80)
    };

    tables.push(newTable);
    renderActiveView();
    updateDailyKPIs();
    selectTable(newTable.id);
}

function deleteSelectedTable() {
    if (!selectedTableId) return;
    if (confirm("¿Estás seguro de que deseas eliminar permanentemente esta mesa de la distribución?")) {
        tables = tables.filter(t => t.id !== selectedTableId);
        deselectTable();
        updateDailyKPIs();
    }
}

function obtenerEstadoActivo() {
    // Definimos los nombres exactos de los estados según los IDs de tus botones
    const estados = ['disponible', 'ocupada', 'reservada'];

    // Recorremos cada estado
    for (let estado of estados) {
        let boton = document.getElementById("status-btn-" + estado);
        
        // Verificamos si el botón existe y si tiene la clase 'active'
        if (boton && boton.classList.contains("active")) {
            return estado; // Si está activo, devolvemos el estado (ej: 'disponible') y salimos de la función
        }
    }

    // Si termina el ciclo y no encontró ninguno activo, devuelve null
    console.log("Ningún botón está activo");
    alert('Seleccione una mesa antes de asignarla');
    return null; 
}

function pintarTarjetas(reservas) {
    const contenedor = document.getElementById('container-reservas');
    contenedor.innerHTML = ''; // Limpiar contenedor antes de renderizar

    if (reservas.length === 0) {
        contenedor.innerHTML = '<p class="text-white">No hay reservas confirmadas en este horario.</p>';
        return;
    }

    reservas.forEach(reserva => {
        // Manejar valores nulos para evitar mostrar "null" en la tarjeta
        const label = reserva.label ? reserva.label : '';
        const specialTime = reserva.special_time ? reserva.special_time : '';

        const cardHtml = `
            
                <div class="card text-white bg-dark mb-3" style="max-width: 22rem;">
                    <div class="card-header me-2">
                        <i class="fa-solid fa-user me-2" style="color: rgb(255, 255, 255);"></i> 
                        <span class="nombre_usuario">${reserva.name}</span> 
                        <span class="badge bg-secondary text-white mr-2">
                            <i class="fa-solid fa-hashtag mr-2" style="color: rgb(255, 255, 255);"></i> 
                            <span class="id_reserva">${reserva.id}</span>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa-solid fa-calendar me-2" style="color: rgb(255, 255, 255);"></i>
                            <span class="reservation_date">${reserva.reservation_date}</span>
                        </h5>                    
                        <p class="card-text"> 
                            <i class="fa-solid fa-clock me-2 mt-1" style="color: rgb(255, 255, 255);"></i> 
                            <span class="reservation_time">${reserva.reservation_time}</span>
                        </p>
                        <span class="badge bg-success text-white me-1">
                            <i class="fa-solid fa-users me-2" style="color: rgb(250, 250, 250);"></i>Comensales: 
                            <span class="comensales">${reserva.guests}</span> 
                        </span>  
                        <span class="badge bg-success text-white mr-2">
                            <i class="fa-solid fa-baby me-2" style="color: rgb(255, 255, 255);"></i>Niños: 
                            <span class="ninos">${reserva.kids_count}</span>
                        </span><br> 
                        
                        <span class="badge bg-warning text-dark mt-2 me-1">
                            <i class="fa-solid fa-utensils me-2" style="color: rgb(0, 0, 0);"></i>
                            <span class="service">${reserva.service}</span>
                        </span>
                        
                        ${label ? `<span class="badge bg-warning text-dark mt-2 me-1"><i class="fa-solid fa-tag me-2" style="color: rgb(0, 0, 0);"></i>${label}</span>` : ''}
                        ${specialTime ? `<span class="badge bg-warning text-dark mt-2"><i class="fa-solid fa-cake-candles me-2" style="color: rgb(0, 0, 0);"></i>${specialTime}</span>` : ''}
                    </div>
                    <div class="card-footer border-success align-items-center d-flex justify-content-center">
                        <button type="button" onclick="store_detalle_reserva(event, ${reserva.id})" class="btn btn-success btn-sm me-2 ps-5 pe-5">
                            <i class="fa-solid fa-floppy-disk me-2" style="color: rgb(255, 255, 255);"></i>Asignar
                        </button>
                    </div>
                </div>
            
        `;

        contenedor.innerHTML += cardHtml;
    });
}


async function obtenerReservas(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Obtenemos los valores de fecha y hora de la interfaz
    const fechaInput = document.getElementById('reservation_date_control') || document.getElementById('reservation_date');
    const horaInput = document.getElementById('reservation_time_control') || document.getElementById('reservation_time');
    
    const fecha = fechaInput ? fechaInput.value : '';
    let hora = horaInput ? horaInput.value : '';

   

    try {
        // Construimos la URL enviando la fecha y la hora si existen
        let url = '/get_reservas_mesas';
        const params = new URLSearchParams();
        if (fecha) params.append('fecha', fecha);
        if (hora) params.append('hora', hora);
        if (params.toString()) url += `?${params.toString()}`;

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        if (!response.ok) {
            throw new Error(`Error HTTP! Estado: ${response.status}`);
        }

        const data = await response.json();
         pintarTarjetas(data.data);
        // Mapeamos el resultado: Si el backend indica que está ocupada por traslape de 2 horas, asignamos el estado dinámico
       
        console.log('Reservas cargadas correctamente:', data);
        
        renderActiveView();
        updateDailyKPIs();
      

    } catch (error) {
        console.error('Error al obtener las mesas:', error);
    }
}

 async function store_detalle_reserva(event, idReserva) {
    // Obtenemos el token CSRF desde el meta tag de Laravel (asegúrate de que exista en tu HTML)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // 1. Obtener el botón al que se le hizo clic
    const boton = event.currentTarget;

    // 2. Buscar el contenedor de la tarjeta más cercano
    const tarjeta = boton.closest('.card');

    let id_mesa = document.getElementById("id_mesa").innerText;

    let name = tarjeta.querySelector('.nombre_usuario').textContent;
    let comensales = tarjeta.querySelector('.comensales').textContent;
    let service = tarjeta.querySelector('.service').textContent;
    let ninos = tarjeta.querySelector('.ninos').textContent;
    let id_reserva= tarjeta.querySelector('.id_reserva').textContent;
    let reservation_date = tarjeta.querySelector('.reservation_date').textContent;
    let reservation_time = tarjeta.querySelector('.reservation_time').textContent;
    
    let [horas, minutos] = reservation_time.split(':').map(Number);
    
    horas+= 2;
    let horaFinal = `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}`;
    
    let estadoActual = obtenerEstadoActivo();
    if (estadoActual) {
     estadoActual;
    // Aquí ya puedes usar la variable "estadoActual" para guardarlo en base de datos, etc.
    }

    let detalle_reserva = {
        id_mesa: id_mesa,
        name:name,
        comensales: comensales,
        service: service,
        ninos: ninos,
        id_reserva: id_reserva,
        reservation_date: reservation_date,
        reservation_time: reservation_time,
        reservation_out: horaFinal,
        state_atention: "Pendiente",
        state_mesa: estadoActual,
    };

    console.log("DETALLE RESERVA" , detalle_reserva);
    
        try {
            const response = await fetch('/guardar_detalle_reserva', { // Cambia '/api/tables' por tu ruta en Laravel
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(detalle_reserva)
            });

            if (!response.ok) {
                throw new Error(`Error en la petición: ${response.statusText}`);
                
            }else{
                 updateMesasAsignacion(id_reserva);
                 tarjeta.style.display = "none";
            }

            const data = await response.json();
           
            console.log(data);
            location.reload();

        } catch (error) {
            console.error('Error guardando el detalle de reserva', error);
        }
    
    
    console.log("¡Detalle de Reserva Guardado!");
   
}

async function updateMesasAsignacion(id) {
    const url = `/update_mesas_asignacion/${id}`;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                 headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            },
            
        });

        if (!response.ok) {
            throw new Error(`Error en la petición: ${response.status} ${response.statusText}`);
        }
        
         return "RESERVA ASIGNADA";
          ;
    } catch (error) {
        console.error('Hubo un problema con la operación fetch:', error);
        throw error;
    }

    
}


document.addEventListener('DOMContentLoaded', () => {
    const botonQuitar = document.getElementById('btn-quitar-asignacion');
    const reservaIdElement = document.getElementById('reserva_id_lbl');

    // Verificamos que ambos elementos existan en la página antes de continuar
    if (botonQuitar && reservaIdElement) {
        
        botonQuitar.addEventListener('click', () => {
            // Deshabilitamos el botón temporalmente para evitar doble clic
            botonQuitar.disabled = true;

            // Tomamos el texto dentro del elemento (usa .value si fuera un <input>)
            const reservaId = reservaIdElement.textContent.trim() || reservaIdElement.value;
            
            // Obtenemos el token CSRF obligatorio de Laravel
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Realizamos la petición fetch
            fetch(`/update_mesas_quitar_asignacion/${reservaId}`, {
                method: 'PUT', // Cambia a 'POST' si tu archivo de rutas web.php usa Route::post
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                // Volvemos a habilitar el botón al recibir respuesta
                botonQuitar.disabled = false;

                // Si el controlador te rebota por falta de permisos (y devuelve una vista/redirección)
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }

                return response.json().then(data => {
                    if (response.ok) {
                        alert('¡Asignación quitada con éxito!');
                        eliminarDetalleReserva(reservaId, botonQuitar);
                        // Opcional: Recargar la página para ver cambios
                         location.reload();
                    } else {
                        // Manejo de errores controlados (ej. No autorizado 403 o No encontrado 404)
                        alert(`Error: ${data.error || 'No se pudo procesar la solicitud'}`);
                    }
                });
            })
            .catch(error => {
                botonQuitar.disabled = false;
                console.error('Error en la petición:', error);
                alert('Ocurrió un error inesperado en el servidor.');
            });

            

        });

    } else {
        console.warn('No se encontró el botón o el label del ID de la reserva en el DOM.');
    }
});

function eliminarDetalleReserva(id_reserva, boton = null) {
    // 1. Obtener el token CSRF obligatorio de Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!csrfToken) {
        console.error('No se encontró el token CSRF en los meta tags.');
        return;
    }

    // 2. Deshabilitar el botón temporalmente si fue enviado
    if (boton) boton.disabled = true;

    // 3. Ejecutar la petición FETCH
    fetch(`/destroy_detalle_reserva/${id_reserva}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(async (response) => {
        // Volver a habilitar el botón al recibir respuesta
        if (boton) boton.disabled = false;

        const data = await response.json();
        if (response.ok) {
            alert(data.message || 'Eliminado con éxito');

            // Opción A: Recargar la página automáticamente
            location.reload();

        } else {
            // Manejar errores devueltos por el controlador (403, 404, etc.)
            alert(`Error: ${data.error || 'No se pudo eliminar el registro'}`);
        }
    })
    .catch(error => {
        if (boton) boton.disabled = false;
        console.error('Error en la petición:', error);
        alert('Ocurrió un error de red o el servidor no respondió.');
    });
}



function mesas_atendido() {
    // 1. Obtener el token CSRF obligatorio de Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
     const reservaIdElement = document.getElementById('reserva_id_lbl');
     const botonAtendido = document.getElementById('btn-atendido');
    if (!csrfToken) {
        console.error('No se encontró el token CSRF en los meta tags.');
        return;
    }
    const reservaId = reservaIdElement.textContent.trim() || reservaIdElement.value;
    // 2. Deshabilitar el botón temporalmente si fue enviado
    if (botonAtendido) botonAtendido.disabled = true;

    // 3. Ejecutar la petición FETCH
    fetch(`/mesas_atendido_state/${reservaId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(async (response) => {
        // Volver a habilitar el botón al recibir respuesta
        if (botonAtendido) botonAtendido.disabled = false;

        const data = await response.json();
        if (response.ok) {
            alert(data.message || 'Reserva Atendida');
            eliminarDetalleReserva(reservaId);
            // Opción A: Recargar la página automáticamente
            location.reload();

        } else {
            // Manejar errores devueltos por el controlador (403, 404, etc.)
            alert(`Error: ${data.error || 'No se pudo dar por atendida la reserva'}`);
        }
    })
    .catch(error => {
        if (botonAtendido) botonAtendido.disabled = false;
        console.error('Error en la petición:', error);
        alert('Ocurrió un error de red o el servidor no respondió.');
    });
}



function updateDailyKPIs() {
    const zoneTables = tables.filter(t => t.zone === activeZone);

    const countDisponible = zoneTables.filter(t => t.status === 'disponible').length;
    const countOcupada = zoneTables.filter(t => t.status === 'ocupada').length;
    const countReservada = zoneTables.filter(t => t.status === 'reservada').length;
    const countMantenimiento = zoneTables.filter(t => t.status === 'mantenimiento').length;

    const lblDisponible = document.getElementById('lbl-count-disponibles');
    const lblOcupada = document.getElementById('lbl-count-ocupadas');
    const lblReservada = document.getElementById('lbl-count-reservadas');
    const lblMantenimiento = document.getElementById('lbl-count-mantenimiento');
    const lblTotalSeats = document.getElementById('lbl-total-seats');
    const lblOccupancyRate = document.getElementById('lbl-occupancy-rate');

    if (lblDisponible) lblDisponible.innerText = countDisponible;
    if (lblOcupada) lblOcupada.innerText = countOcupada;
    if (lblReservada) lblReservada.innerText = countReservada;
    if (lblMantenimiento) lblMantenimiento.innerText = countMantenimiento;

    const totalSeats = zoneTables.reduce((sum, t) => sum + (t.status !== 'mantenimiento' ? t.capacity : 0), 0);
    if (lblTotalSeats) lblTotalSeats.innerText = `${totalSeats} pax`;

    const operativas = zoneTables.filter(t => t.status !== 'mantenimiento').length;
    const ocupadas = zoneTables.filter(t => t.status === 'ocupada').length;
    const rate = operativas > 0 ? Math.round((ocupadas / operativas) * 100) : 0;
    if (lblOccupancyRate) lblOccupancyRate.innerText = `${rate}%`;
}