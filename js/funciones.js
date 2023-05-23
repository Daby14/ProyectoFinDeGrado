//Formulario de Contacto
let form = document.getElementById("formContacto");

if (form !== null) {
    document.getElementById("formContacto").addEventListener("submit", function (event) {
        // Prevenir que el formulario se envíe automáticamente
        event.preventDefault();

        // Validar el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            // Si el formulario es válido, abrir el modal
            $('#miModal').modal('show');

            let cerrar = document.getElementById("cerrar");

            cerrar.addEventListener("click", function () {

                window.location.href = "https://hotelgdfree.epizy.com/";

            })

        }
    }, false);
}

//Formulario de Sesión
let formSesion = document.getElementById("formSesion");

if (formSesion !== null) {
    formSesion.addEventListener("submit", function (event) {
        // Prevenir que el formulario se envíe automáticamente
        event.preventDefault();

        // Validar el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            let usuario = document.getElementById("usuario").value;

            let password = document.getElementById("password").value;

            window.location.href = "https://hotelgdfree.epizy.com/?sesion&usuario=" + usuario + "&password=" + password;

        }
    }, false);
}

//Formulario de Registro
let formRegistro = document.getElementById("formRegistro");

if (formRegistro !== null) {
    formRegistro.addEventListener("submit", function (event) {
        // Prevenir que el formulario se envíe automáticamente
        event.preventDefault();

        // Validar el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            let nombre = document.getElementById("nombre").value;
            let apellido = document.getElementById("apellido").value;
            let usuario = document.getElementById("usuario").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;
            let telefono = document.getElementById("telefono").value;

            window.location.href = "https://hotelgdfree.epizy.com/?nombre=" + nombre + "&apellido=" + apellido + "&usuario=" + usuario + "&password=" + password + "&email=" + email + "&telefono=" + telefono + "";

        }
    }, false);
}

//Si le damos a reservar


//Comprobamos si hemos pulsado el carrito
let carrito = $('#carrito');

carrito.click(() => {

    location.href = 'https://hotelgdfree.epizy.com/?carrito';

});

//Formulario de Reserva
// let formReserva = document.getElementById("formReserva");

// if (formReserva !== null) {
//     formReserva.addEventListener("submit", function (event) {
//         // Prevenir que el formulario se envíe automáticamente
//         event.preventDefault();

//         // Validar el formulario
//         if (this.checkValidity() === false) {
//             event.stopPropagation();
//             this.classList.add('was-validated');
//         } else {

//             let fechaInicio = document.getElementById("fechaInicio").value;

//             let fechaFin = document.getElementById("fechaFin").value;

//             let id = document.getElementById("id").value;

//             window.location.href = "https://hotelgdfree.epizy.com/?fechaInicio=" + fechaInicio + "&fechaFin=" + fechaFin + "&id_habitacion=" + id;

//         }
//     }, false);
// }

//Obtenemos el id de la reserva a cancelar
let cancelar = $('#reservas');

cancelar.find('a').click((event) => {

    var type = $(event.target).closest($('a')).get(0).dataset.type;

    location.href = 'https://hotelgdfree.epizy.com/?idReserva=' + type;

    $('#modalConfirmacionCancelacionReserva').modal('show');

});




