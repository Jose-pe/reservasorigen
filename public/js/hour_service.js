  // =========================
    // HORARIOS
    // =========================
let personas = localStorage.getItem('campoGuests');

let comensales = document.getElementById('peopleSelected'); 
comensales.innerHTML= personas;

 const dateSaved =
    localStorage.getItem('campoDate');
let fecha = document.getElementById('serviceDate');

  fecha.innerText =
    dateSaved;

    const lunchHours = [
      '11:00','11:30',
      '12:00','12:30','13:00',
      '13:30','14:00','14:30',
      '15:00','15:30','16:00'
      
    ];

    const dinnerHours = [
      '18:00','18:30','19:00',
      '19:30','20:00','20:30',
      '21:00','21:30','22:00',
      '22:30'
    ];

    const service =
      localStorage.getItem('campoService');

    const timeList =
      document.getElementById('timeList');

    // =========================
    // GENERAR HORARIOS
    // =========================

    function generateHours(){

      const hours =
        service === 'Cena'
        ? dinnerHours
        : lunchHours;

      timeList.innerHTML = '';

      hours.forEach(hour=>{

        const button =
          document.createElement('a');
          button.href = "/reservas_preferencias";
        button.className = 'time-btn';

        button.innerHTML = `
          <i class="bi bi-clock"></i>
          ${hour}
        `;

        // click
        button.addEventListener('click', ()=>{

          // remover activos
          document
            .querySelectorAll('.time-btn')
            .forEach(btn=>{
              btn.classList.remove('active');
            });

          // activar
          button.classList.add('active');

          // guardar
          localStorage.setItem(
            'campoHour',
            hour
          );

          console.log(
            'Hora guardada:',
            hour
          );

        });

        timeList.appendChild(button);
        
      });
      service_assign();
      
    }

    function service_assign(){
        const service_final =
      localStorage.getItem('campoService');
        const service =  document.getElementById('service-pill');
        service.innerHTML = service_final;
    }

    generateHours();

