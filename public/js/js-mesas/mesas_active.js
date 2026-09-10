   //MESAS SALON PRINCIPAL 
        let tables = [];
       
        async function getTables() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    try {
        const response = await fetch('/listar_mesas', { // Cambia esta URL por la ruta GET de tu controlador en Laravel
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

        // Asignamos la respuesta en formato JSON a la variable let tables
       tables= await response.json();

        // Convertimos el objeto en un array si es necesario
        
        console.log('Mesas cargadas correctamente json:', tables);
        
        // Aquí puedes llamar a la función que dibuje o procese las mesas en tu interfaz
         renderActiveView();

    } catch (error) {
        console.error('Error al obtener las mesas:', error);
    }
}

const fechaSeleccionada = document.getElementById('reservation_date_control');

fechaSeleccionada.addEventListener('change', (event) => {
   const selectdate = event.target.value;
   fetch(`/mostrar_porfecha?fecha=${selectdate}`, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
})
.then(response => response.json())
.then(data => {
    console.log('Resultados:', data);
    // Actualiza tu vista aquí
})
.catch(error => console.error('Error:', error));
});// Formato esperado: 'YYYY-MM-DD'




    async function storeTables() {
    // Obtenemos el token CSRF desde el meta tag de Laravel (asegúrate de que exista en tu HTML)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    for (const table of tables) {
        try {
            const response = await fetch('/guardar_mesas', { // Cambia '/api/tables' por tu ruta en Laravel
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

        const hoy = new Date();
  
        // 2. La formateamos como AAAA-MM-DD
        const anio = hoy.getFullYear();
        // El mes empieza en 0 (enero), por lo que sumamos 1 y aseguramos dos dígitos
        const mes = String(hoy.getMonth() + 1).padStart(2, '0'); 
        const dia = String(hoy.getDate()).padStart(2, '0');
        
        const fechaMinima = `${anio}-${mes}-${dia}`;
        
        // 3. Le asignamos ese valor al atributo 'min' del input
        // Establece la fecha actual como valor predeterminado
        document.getElementById('reservation_date').min = fechaMinima;
               
        let selectedTableId = null;
        let activeZone = "salon";
        let activeView = "map";
        let activeShift = "almuerzo";
        let draggingElement = null;
        let dragOffset = { x: 0, y: 0 };
          
        window.addEventListener('DOMContentLoaded', () => {
            getTables();
            renderActiveView();
            updateDailyKPIs();         
        });

        function setZone(zoneName) {
            activeZone = zoneName; 
             
                 ['salon','mezaninne'].forEach(z => {
               
                const btn = document.getElementById(`zone-${z}`);
                if (z === zoneName) {
                    btn.className = "btn btn-sm btn-dark active fw-semibold rounded-2 px-3";
                } else {
                    btn.className = "btn btn-sm text-secondary fw-semibold rounded-2 px-3";
                }          

            });       
                deselectTable();
                renderActiveView();           
            } 
       

        function switchView(viewName) {
            activeView = viewName;
            const mapBtn = document.getElementById('view-map-btn');
            const listBtn = document.getElementById('view-list-btn');
            const mapView = document.getElementById('view-map');
            const listView = document.getElementById('view-list');

            if (viewName === 'map') {
                mapBtn.className = "btn btn-amber btn-sm rounded-2";
                listBtn.className = "btn btn-sm text-secondary rounded-2";
                mapView.classList.remove('d-none');
                listView.classList.add('d-none');
            } else {
                listBtn.className = "btn btn-amber btn-sm rounded-2";
                mapBtn.className = "btn btn-sm text-secondary rounded-2";
                listView.classList.remove('d-none');
                mapView.classList.add('d-none');
            }
            renderActiveView();
        }

      /*  function setShift(shiftName) {
            activeShift = shiftName;
            const lunchBtn = document.getElementById('btn-lunch');
            const dinnerBtn = document.getElementById('btn-dinner');
            const timeLabel = document.getElementById('current-time');

            if (shiftName === 'almuerzo') {
                lunchBtn.className = "btn btn-amber btn-sm rounded-2 px-3 py-1 text-xs fw-semibold";
                dinnerBtn.className = "btn btn-sm text-secondary rounded-2 px-3 py-1 text-xs fw-semibold";
                timeLabel.innerText = "Turno actual: 13:00 - 16:30";
            } else {
                dinnerBtn.className = "btn btn-amber btn-sm rounded-2 px-3 py-1 text-xs fw-semibold";
                lunchBtn.className = "btn btn-sm text-secondary rounded-2 px-3 py-1 text-xs fw-semibold";
                timeLabel.innerText = "Turno actual: 20:00 - 23:45";
            }
        }*/

        function renderActiveView() {
            if (activeView === 'map') {
                renderFloorplan();
            } else {
                renderTableList();
            }
        }

        function renderFloorplan() {
            const container = document.getElementById('interactive-map');
            container.innerHTML = '';

            const zoneTables = tables.filter(t => t.zone === activeZone);
              if (activeZone === 'mezaninne') {
                document.getElementById('visual-decor-bar-1').classList.add('d-none');
                document.getElementById('visual-decor-bar-2').classList.add('d-none');
                document.getElementById('visual-decor-bar-3').classList.add('d-none');
                document.getElementById('visual-decor-kitchen-1').classList.add('d-none');
                document.getElementById('visual-decor-kitchen-2').classList.add('d-none');
                document.getElementById('visual-divisor-1').classList.remove('d-none');
                document.getElementById('visual-divisor-2').classList.remove('d-none');
            } else if (activeZone === 'salon') {
                    document.getElementById('visual-decor-bar-1').classList.remove('d-none');
                     document.getElementById('visual-decor-bar-2').classList.remove('d-none');
                     document.getElementById('visual-decor-bar-3').classList.remove('d-none');
                     document.getElementById('visual-decor-kitchen-1').classList.remove('d-none');
                     document.getElementById('visual-decor-kitchen-2').classList.remove('d-none');
                     document.getElementById('visual-divisor-1').classList.add('d-none');
                     document.getElementById('visual-divisor-2').classList.add('d-none');
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
                if (table.capacity <= 2) {
                    sizeStyle = { width: '120px', height: '65px', fontSize: '0.7rem' };
                } else if (table.capacity === 4) {
                    sizeStyle = { width: '130px', height: '100px', fontSize: '0.85rem' };
                } else if (table.capacity === 6) {
                    sizeStyle = { width: '110px', height: '150px', fontSize: '0.85rem' };
                } else if (table.capacity === 7) {
                    sizeStyle = { width: '150px', height: '110px', fontSize: '1rem' };
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
            const containerRect = floorContainer.getBoundingClientRect();
            
            let newX = e.clientX - containerRect.left - dragOffset.x;
            let newY = e.clientY - containerRect.top - dragOffset.y;

            const tableEl = document.getElementById(`map-table-${draggingElement.id}`);
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
            tbody.innerHTML = '';

            const statusFilter = document.getElementById('filter-status').value;
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

            renderActiveView();
            document.getElementById('id_mesa').innerText = `${table.id}`;
            document.getElementById('empty-state-sidebar').classList.add('d-none');
            document.getElementById('editor-form-sidebar').classList.remove('d-none');
            //document.getElementById('btn-save-asignation').classList.remove('d-none');
            //document.getElementById('btn-delete-asignation').classList.remove('d-none');
            
            //document.getElementById('edit-table-number').value = table.number;
            //document.getElementById('edit-table-capacity').value = table.capacity;
            //document.getElementById('edit-table-zone').value = table.zone;

            updateStatusButtonsInSidebar(table.status);
            //updateShapeButtonsInSidebar(table.shape);

          

           
        }

        function deselectTable() {
            selectedTableId = null;
            document.getElementById('empty-state-sidebar').classList.remove('d-none');
            document.getElementById('editor-form-sidebar').classList.add('d-none');
            //document.getElementById('btn-save-asignation').classList.add('d-none');
            //document.getElementById('btn-delete-asignation').classList.add('d-none');
            document.getElementById('id_mesa').innerHTML = '';
            renderActiveView();
        }

        function setTableStatus(status) {
            if (!selectedTableId) return;
            const table = tables.find(t => t.id === selectedTableId);
            table.status = status;
            
            updateStatusButtonsInSidebar(status);
            renderActiveView();
            updateDailyKPIs();
            selectTable(selectedTableId);
        }

        function updateStatusButtonsInSidebar(status) {
            const btns = {
                disponible: document.getElementById('status-btn-disponible'),
                ocupada: document.getElementById('status-btn-ocupada'),
                reservada: document.getElementById('status-btn-reservada'),
                mantenimiento: document.getElementById('status-btn-mantenimiento')
            };

            Object.keys(btns).forEach(key => {
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
            });
        }

        /*function adjustCapacity(amount) {
            if (!selectedTableId) return;
            const table = tables.find(t => t.id === selectedTableId);
            
            const newCap = table.capacity + amount;
            if (newCap >= 1 && newCap <= 12) {
                table.capacity = newCap;
                document.getElementById('edit-table-capacity').value = newCap;
                renderActiveView();
                updateDailyKPIs();
            }
        }*/

        function setTableShape(shape) {
            if (!selectedTableId) return;
            const table = tables.find(t => t.id === selectedTableId);
            table.shape = shape;
            
            updateShapeButtonsInSidebar(shape);
            renderActiveView();
        }

        /*function updateShapeButtonsInSidebar(shape) {
            const btnSquare = document.getElementById('shape-btn-square');
            const btnRound = document.getElementById('shape-btn-round');

            if (shape === 'square') {
                btnSquare.className = "btn btn-sm btn-dark text-white fw-semibold text-xs";
                btnRound.className = "btn btn-sm text-secondary fw-semibold text-xs";
            } else {
                btnRound.className = "btn btn-sm btn-dark text-white fw-semibold text-xs";
                btnSquare.className = "btn btn-sm text-secondary fw-semibold text-xs";
            }
        }*/

       /* function saveLiveChanges() {
            if (!selectedTableId) return;
            const table = tables.find(t => t.id === selectedTableId);
            table.number = document.getElementById('edit-table-number').value.trim() || table.id.toString();
            
            const prevZone = table.zone;
            const newZone = document.getElementById('edit-table-zone').value;
            table.zone = newZone;

            renderActiveView();
        }*/

        function addNewTable() {
            const nextId = tables.length > 0 ? Math.max(...tables.map(t => t.id)) + 1 : 1;
            
            let letter = "M";
            if (activeZone === 'mezaninne') letter = "M";
           // if (activeZone === 'barra') letter = "B";

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

        function updateDailyKPIs() {
            const zoneTables = tables.filter(t => t.zone === activeZone);

            const countDisponible = zoneTables.filter(t => t.status === 'disponible').length;
            const countOcupada = zoneTables.filter(t => t.status === 'ocupada').length;
            const countReservada = zoneTables.filter(t => t.status === 'reservada').length;
            const countMantenimiento = zoneTables.filter(t => t.status === 'mantenimiento').length;

            document.getElementById('lbl-count-disponibles').innerText = countDisponible;
            document.getElementById('lbl-count-ocupadas').innerText = countOcupada;
            document.getElementById('lbl-count-reservadas').innerText = countReservada;
            document.getElementById('lbl-count-mantenimiento').innerText = countMantenimiento;

            const totalSeats = zoneTables.reduce((sum, t) => sum + (t.status !== 'mantenimiento' ? t.capacity : 0), 0);
            document.getElementById('lbl-total-seats').innerText = `${totalSeats} pax`;

            const operativas = zoneTables.filter(t => t.status !== 'mantenimiento').length;
            const ocupadas = zoneTables.filter(t => t.status === 'ocupada').length;
            const rate = operativas > 0 ? Math.round((ocupadas / operativas) * 100) : 0;
            document.getElementById('lbl-occupancy-rate').innerText = `${rate}%`;
        }



       
           