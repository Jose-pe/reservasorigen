const calendarBody = document.getElementById('calendarBody');
const monthDisplay = document.getElementById('monthDisplay');
const selectedDateText = document.getElementById('selectedDateText');

let date = new Date();
function formatDate(day, month, year) {
  const d = String(day).padStart(2, '0');
  const m = String(month + 1).padStart(2, '0'); // +1 porque los meses en JS van de 0 a 11
  const y = year;
  return `${d}/${m}/${y}`;
}

function renderCalendar() {
  calendarBody.innerHTML = "";
  const year = date.getFullYear();
  const month = date.getMonth();
  
  const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  monthDisplay.innerText = `${monthNames[month]} ${year}`;

  const firstDay = new Date(year, month, 1).getDay();
  const lastDay = new Date(year, month + 1, 0).getDate();
  
  // Recuperar fecha guardada en formato dd/mm/yyyy
  const savedDate = localStorage.getItem('selectedCalendarDate');

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
    // Creamos la fecha en formato dd/mm/yyyy
    const dateString = formatDate(day, month, year);
    
    cell.innerText = day;
    
    // Comparación con el formato guardado
    if (savedDate === dateString) {
      cell.classList.add('selected');
      selectedDateText.innerText = dateString;
    }

    cell.onclick = () => {
      // Guardar con el nuevo formato
      localStorage.setItem('campoDate', dateString);
      
      document.querySelectorAll('#calendarBody td').forEach(td => td.classList.remove('selected'));
      cell.classList.add('selected');
      selectedDateText.innerText = dateString;
    };

    row.appendChild(cell);
  }
  calendarBody.appendChild(row);
}
renderCalendar();
// Navegación
document.getElementById('prevMonth').onclick = () => { date.setMonth(date.getMonth() - 1); renderCalendar(); };
document.getElementById('nextMonth').onclick = () => { date.setMonth(date.getMonth() + 1); renderCalendar(); };

