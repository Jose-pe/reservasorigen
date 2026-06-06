// 1. Variables y elementos del DOM
const calendarBody = document.getElementById('calendarBody');
const monthDisplay = document.getElementById('monthDisplay');
const selectedDateText = document.getElementById('selectedDateText');

// Esta variable debe estar FUERA de la función para que los botones la puedan modificar
let date = new Date(); 

// 2. Función para formatear la fecha
function formatDate(day, month, year) {
  const d = String(day).padStart(2, '0');
  const m = String(month + 1).padStart(2, '0'); // +1 porque los meses van de 0 a 11
  const y = year;
  return `${d}/${m}/${y}`;
}

// 3. Función principal para dibujar el calendario
function renderCalendar() {
  calendarBody.innerHTML = "";
  const year = date.getFullYear();
  const month = date.getMonth();
  
  const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  monthDisplay.innerText = `${monthNames[month]} ${year}`;

  const firstDay = new Date(year, month, 1).getDay();
  const lastDay = new Date(year, month + 1, 0).getDate();
  
  const savedDate = localStorage.getItem('selectedCalendarDate');

  const today = new Date();
  today.setHours(0, 0, 0, 0);

  let row = document.createElement('tr');
  
  for (let i = 0; i < firstDay; i++) {
    row.appendChild(document.createElement('td'));
  }

  for (let day = 1; day <= lastDay; day++) {
    if ((firstDay + day - 1) % 7 === 0 && day !== 1) {
      calendarBody.appendChild(row);
      row = document.createElement('tr');
    }

    const cell = document.createElement('td');
    const dateString = formatDate(day, month, year);
    
    cell.innerText = day;
    
    const currentCellDate = new Date(year, month, day);

    // Validación de fechas pasadas
    if (currentCellDate < today) {
      cell.classList.add('disabled'); 
    } else {
      if (savedDate === dateString) {
        cell.classList.add('selected');
        if(selectedDateText) selectedDateText.innerText = dateString;
      }

      cell.onclick = () => {
        localStorage.setItem('campoDate', dateString);
        
        document.querySelectorAll('#calendarBody td').forEach(td => td.classList.remove('selected'));
        cell.classList.add('selected');
        if(selectedDateText) selectedDateText.innerText = dateString;
      };
    }

    row.appendChild(cell);
  }
  calendarBody.appendChild(row);
}

// 4. Eventos de Navegación (Botones Mes Anterior / Siguiente)
document.getElementById('prevMonth').onclick = (e) => { 
  e.preventDefault(); // Evita recargas si el botón está en un formulario
  date.setMonth(date.getMonth() - 1); 
  renderCalendar(); 
};

document.getElementById('nextMonth').onclick = (e) => { 
  e.preventDefault();
  date.setMonth(date.getMonth() + 1); 
  renderCalendar(); 
};

// 5. Inicializar el calendario al cargar la página
renderCalendar();