// =========================
// GENERAR FECHAS DINÁMICAS
// =========================

let personas = localStorage.getItem('campoGuests');

let comensales = document.getElementById('peopleSelected'); 
comensales.innerHTML= personas;

const dateSlider =
  document.getElementById('dateSlider');

const months = [
  'ene','feb','mar','abr',
  'may','jun','jul','ago',
  'sep','oct','nov','dic'
];

const days = [
  'dom','lun','mar',
  'mié','jue','vie','sáb'
];

// =========================
// CREAR 5 FECHAS
// =========================

function generateDates(){

  dateSlider.innerHTML = '';

  for(let i = 0 ; i < 5; i++){

    const currentDate = new Date();

    currentDate.setDate(
      currentDate.getDate() + i
    );

    const dayNumber =
      currentDate.getDate();

    const month =
      months[currentDate.getMonth()];

    const dayName =
      i === 0
      ? 'Hoy'
      : days[currentDate.getDay()];

    // formato YYYY-MM-DD
    const fullDate =
      currentDate.toLocaleDateString('es-ES');

    // crear card
    const card =
      document.createElement('div');

    card.className =
      i === 0
      ? 'date-card active'
      : 'date-card';

    card.innerHTML = `
      <span>${dayName}</span>
      <h3>${dayNumber}</h3>
      <small>${month}</small>
    `;

    // click
    card.addEventListener('click', ()=>{

      document
        .querySelectorAll('.date-card')
        .forEach(c=>{
          c.classList.remove('active');
        });

      card.classList.add('active');

      // guardar fecha
      localStorage.setItem(
        'campoDate',
        fullDate
      );

      console.log(
        'Fecha guardada:',
        fullDate
      );

    });

    dateSlider.appendChild(card);

    // guardar primera fecha automáticamente
    if(i === 0){

      localStorage.setItem(
        'campoDate',
        fullDate
      );

    }

  }

}

// =========================
// INICIAR
// =========================

generateDates();