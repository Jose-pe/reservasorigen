let personas = localStorage.getItem('campoGuests');

let comensales = document.getElementById('peopleSelected'); 
comensales.innerHTML= personas;

 const dateSaved =
    localStorage.getItem('campoDate');
let fecha = document.getElementById('serviceDate');

  fecha.innerText =
    dateSaved;
let hour = localStorage.getItem('campoHour');

let showhour = document.getElementById('hour-pill');
showhour.innerHTML= hour; 

let phone = document.getElementById('userPhone');


localStorage.setItem('mailUserPhone', phone.innerText);
  
    // =========================
    // ESTADO
    // =========================

    let reservationPreferences = {

      foodRestrictions: false,
      foodDescription: '',

      kidsUnder12: false,
      kidsCount: 0

    };

    // =========================
    // ELEMENTOS
    // =========================

    const foodTextarea =
      document.getElementById('foodTextarea');

    const kidsContainer =
      document.getElementById('kidsContainer');

    const kidsCount =
      document.getElementById('kidsCount');

    // =========================
    // TOGGLE FOOD
    // =========================

    function toggleFood(value, button){

      reservationPreferences.foodRestrictions =
        value;

      // botones
      const group =
        button.parentElement;

      group.querySelectorAll('.toggle-btn')
        .forEach(btn=>{
          btn.classList.remove('active');
        });

      button.classList.add('active');

      // textarea
      if(value){

        foodTextarea.style.display = 'block';

      }else{

        foodTextarea.style.display = 'none';

        reservationPreferences.foodDescription = '';

        foodTextarea.value = '';

      }

      savePreferences();

    }

    // =========================
    // TOGGLE KIDS
    // =========================

    function toggleKids(value, button){

      reservationPreferences.kidsUnder12 =
        value;

      // botones
      const group =
        button.parentElement;

      group.querySelectorAll('.toggle-btn')
        .forEach(btn=>{
          btn.classList.remove('active');
        });

      button.classList.add('active');

      // mostrar contador
      if(value){

        kidsContainer.style.display = 'block';

      }else{

        kidsContainer.style.display = 'none';

        reservationPreferences.kidsCount = 0;

        kidsCount.innerText = 0;

      }

      savePreferences();

    }

    // =========================
    // KIDS COUNTER
    // =========================

    function increaseKids(){

      if ( reservationPreferences.kidsCount == personas ) {
           kidsCount.innerText =
           personas;
            savePreferences();
      }else{
        reservationPreferences.kidsCount++;

      kidsCount.innerText =
        reservationPreferences.kidsCount;
         savePreferences();
      } 


    }

    function decreaseKids(){

      if(reservationPreferences.kidsCount > 1){

        reservationPreferences.kidsCount--;

        kidsCount.innerText =
          reservationPreferences.kidsCount;

        savePreferences();

      }

    }

    // =========================
    // TEXTAREA
    // =========================

    foodTextarea.addEventListener('input', ()=>{

      reservationPreferences.foodDescription =
        foodTextarea.value;

      savePreferences();

    });

    // =========================
    // GUARDAR
    // =========================

    function savePreferences(){

      localStorage.setItem(
        'campoPreferences',
        JSON.stringify(reservationPreferences)
      );

      console.log(
        JSON.parse(
          localStorage.getItem('campoPreferences')
        )
      );

    }

    // =========================
    // CARGAR
    // =========================

    function loadPreferences(){

      const saved =
        localStorage.getItem('campoPreferences');

      if(saved){

        reservationPreferences =
          JSON.parse(saved);

        // FOOD
        if(reservationPreferences.foodRestrictions){

          foodTextarea.style.display = 'block';

          foodTextarea.value =
            reservationPreferences.foodDescription || '';

        }

        // KIDS
        if(reservationPreferences.kidsUnder12){

          kidsContainer.style.display = 'block';

          kidsCount.innerText =
            reservationPreferences.kidsCount;

        }

      }

    }

   

    // =========================
    // CONTINUAR
    // =========================

    document
      .getElementById('continueBtn')
      .addEventListener('click', ()=>{

        savePreferences();

       window.location.href = "/reservas_confirmacion";

      });

    // =========================
    // INIT
    // =========================

    loadPreferences();

