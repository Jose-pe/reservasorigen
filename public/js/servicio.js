

const guestsSaved =
    localStorage.getItem('campoGuests');

let comensales = document.getElementById('servicePeople'); 
comensales.innerHTML= guestsSaved;



setTimeout(()=>{

  // obtener invitados
  
  // obtener fecha
  const dateSaved =
    localStorage.getItem('campoDate');

  /* convertir fecha
  const dateObject =
    new Date(dateSaved);

  const formattedDate =
    days[dateObject.getDay()] +
    ' ' +
    dateObject.getDate() +
    ', ' +
    months[dateObject.getMonth()];*/

let fecha = document.getElementById('serviceDate');

  fecha.innerText =
    dateSaved;

}, 300);


// =========================
// GUARDAR SERVICIO
// =========================

function selectService(service, element){

  // remover active
  document
    .querySelectorAll('.service-card')
    .forEach(card=>{
      card.classList.remove('active');
    });

  // activar card
  element.classList.add('active');

  // guardar en localStorage
  localStorage.setItem(
    'campoService',
    service
  );

  console.log(
    'Servicio guardado:',
    service
  );

    window.location.href = "/reservas_hora";

}