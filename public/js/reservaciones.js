
/*
let guests = 1;

const STORAGE_KEY = "campo_reserva";

const guestCount = document.getElementById("guestCount");
const continueBtn = document.getElementById("btn-continue");

 

// LOAD STORAGE
const saved = JSON.parse(localStorage.getItem(STORAGE_KEY));

if(saved){

    guests = saved.comensales || 1;
    updateUI();

}

// UPDATE UI
function updateUI(){

    guestCount.innerText = guests;

      guestCount.innerText = guests;
    continueCount.innerText = guests;

    // Guardar en localStorage
    localStorage.setItem('campoGuests', guests);

    // Quitar active
    document.querySelectorAll('.guest-card').forEach(card=>{
      card.classList.remove('active');
    });

    // Activar tarjeta correspondiente
    document.querySelectorAll('.guest-card').forEach(card=>{

      const number =
        parseInt(card.querySelector('.guest-number').innerText);

      if(number === guests){
        card.classList.add('active');
      }

    });


    // BOTÓN DINÁMICO
    if(guests > 8){

        continueBtn.innerHTML = `
            <i class="bi bi-whatsapp me-2"></i>
            Contactar por WhatsApp
        `;

        continueBtn.style.background = "#25D366";

        // LINK WHATSAPP
        continueBtn.onclick = () => {

            const mensaje = encodeURIComponent(
                `Hola, deseo realizar una reserva para ${guests} comensales`
            );

            window.open(
                `https://wa.me/51999999999?text=${mensaje}`,
                "_blank"
            );

        };

    }else{

        continueBtn.innerHTML = `
            <i class="bi bi-people me-1"></i>
            Continuar con ${guests} comensal${guests > 1 ? 'es' : ''}
        `;

        continueBtn.style.background = "#000";

        continueBtn.onclick = null;

    }

    // SAVE JSON
    const reservaJSON = {

        comensales: guests,
        fecha: new Date().toISOString()

    };

    localStorage.setItem(
        STORAGE_KEY,
        JSON.stringify(reservaJSON)
    );

}
// PLUS
document.getElementById("plusBtn")
.addEventListener("click",()=>{

    guests++;
   
    updateUI();

});

// MINUS
document.getElementById("minusBtn")
.addEventListener("click",()=>{

    if(guests > 1){

        guests--;
      
    
        updateUI();

    }

});

// CARD CLICK


updateUI();
*/


   



// =========================
// CONTINUAR
// =========================

document
  .getElementById('continueGuests')
  .addEventListener('click', ()=>{

    // guardar invitados
    localStorage.setItem(
      'campoGuests',
      guests
    );

    // actualizar pill  

const peopleSelected =
  document.getElementById('peopleSelected');
    peopleSelected.innerText = guests;

    // ocultar pantalla invitados
    guestScreen.classList.add('d-none');

    // mostrar pantalla fechas
    dateScreen.classList.remove('d-none');

  });

  function backperson(){
      const guestScreen =
  document.getElementById('guestScreen');
  }

  
  // =========================
  // LOCAL STORAGE
  // =========================

  // Obtener datos guardados
  let guests = localStorage.getItem('campoGuests')
    ? parseInt(localStorage.getItem('campoGuests'))
    : 1;

  // ELEMENTOS
  const guestCount = document.getElementById('guestCount');
  const continueCount = document.getElementById('continueCount');

  // =========================
  // ACTUALIZAR UI
  // =========================

  function updateUI(){

    // Actualizar números
    guestCount.innerText = guests;
    continueCount.innerText = guests;

    // Guardar en localStorage
    localStorage.setItem('campoGuests', guests);

    // Quitar active
    document.querySelectorAll('.guest-card').forEach(card=>{
      card.classList.remove('active');
    });

    // Activar tarjeta correspondiente
    document.querySelectorAll('.guest-card').forEach(card=>{

      const number =
        parseInt(card.querySelector('.guest-number').innerText);

      if(number === guests){
        card.classList.add('active');
      }

    });

     if(guests > 8){



       continueGuests.innerHTML = `
            <i class="bi bi-whatsapp me-2"></i>
            Para grupos grandes contactar por WhatsApp
        `;

        continueGuests.style.background = "#25D366";

        // LINK WHATSAPP
        continueGuests.onclick = () => {

            const mensaje = encodeURIComponent(
                `Hola, deseo realizar una reserva para ${guests} comensales`
            );

            window.open(
                `https://wa.me/51999999999?text=${mensaje}`
                
            );

        };

    }else{
         continueGuests.innerHTML = `
        <i class="bi bi-people me-1"></i>
        Continuar con ${guests} comensal${guests > 1 ? 'es' : ''}
    `;

    continueGuests.style.background = "#000";

    continueGuests.onclick = () => {
      

    window.location.href = "/reservas_cliente";
       

    };
    }
  }

  // =========================
  // BOTÓN +
  // =========================

  function increaseGuests(){

    guests++;    

    updateUI();

  }

  // =========================
  // BOTÓN -
  // =========================

  function decreaseGuests(){

    if(guests > 1){

      guests--;

      updateUI();

    }

  }

  // =========================
  // SELECCIONAR TARJETA
  // =========================

  function selectGuests(number){

    guests = number;

    updateUI();

  }

  // =========================
  // CONTINUAR
  // =========================

  document.querySelector('.btn-continue')
    .addEventListener('click', ()=>{

      // Crear objeto reserva
      const reservationData = {

        guests: guests,
        createdAt: new Date().toISOString()

      };

      // Guardar objeto completo
      localStorage.setItem(
        'campoReservation',
        JSON.stringify(reservationData)
      );

    /*  alert(
        `Reserva guardada para ${guests} comensales`
      );*/

      console.log(
        JSON.parse(localStorage.getItem('campoReservation'))
      );

    });

  // =========================
  // INICIALIZAR
  // =========================

  updateUI();