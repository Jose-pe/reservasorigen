// 1. Recogemos los datos (tu código actual)
const fecha_creacion = localStorage.getItem('campoDate');
const personas = parseInt(localStorage.getItem('campoGuests'))
const fecha_reserva = localStorage.getItem('selectedCalendarDate');
const tipo_servicio = localStorage.getItem('campoService');
const hora_servicio = localStorage.getItem('campoHour');
const nombre_cliente = localStorage.getItem('cliente_name');
const correo_electronico = localStorage.getItem('cliente_email');
const telefono_cliente = localStorage.getItem('cliente_telefono');

// 2. Creamos el objeto JSON (Object literal en JS)
const reservaData = {
    reserva: {
        nombre: nombre_cliente,
        correo: correo_electronico,
        telefono: telefono_cliente,
        fecha_creacion: fecha_creacion,
        fecha_reserva: fecha_reserva,
        hora: hora_servicio,
        comensales: personas,
        servicio: tipo_servicio
    }
};

// 3. Si necesitas convertirlo a una cadena de texto JSON (para enviar o guardar)
const reservaJSON = JSON.stringify(reservaData);

console.log("Objeto estructurado:", reservaData);
console.log("JSON listo para enviar:", reservaJSON);