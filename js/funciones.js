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
            // $('#miModal').modal('show');
            $('#miModal').modal('show');

            let cerrar = document.getElementById("cerrar");

            cerrar.addEventListener("click", function () {

                window.location.href = "https://hotelgdfree.epizy.com/";

            })

        }
    }, false);
}

let form2 = document.getElementById("formSesion");

if (form2 !== null) {
    form2.addEventListener("submit", function (event) {
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

            // Si el formulario es válido, abrir el modal
            // $('#modalRegistro').modal('show');

            // let cerrar = document.getElementById("cerrar");

            // cerrar.addEventListener("click", function () {

            // window.location.href = "https://hotelgdfree.epizy.com/?nombre=" + nombre + "&apellido=" + apellido + "&usuario=" + usuario + "&password=" + password + "&email=" + email + "&telefono=" + telefono + "";

            // })

        }
    }, false);
}

let prueba = $('#habitacionesDisponibles');

prueba.find('a').click((event) => {

    var type = $(event.target).closest($('a')).get(0).dataset.type;

    console.log(type);

    // const data = {
    //     type: type
    // };

    // // Hacer la petición HTTP POST al archivo PHP
    // fetch('index.php', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     body: JSON.stringify(data)
    // })
    //     .then(response => {
    //         // Manejar la respuesta del servidor
    //         console.log('Respuesta del servidor:', response);
    //     })
    //     .catch(error => {
    //         // Manejar los errores de la petición
    //         console.error('Error al hacer la petición:', error);
    //     });

    location.href = 'https://hotelgdfree.epizy.com/?id=' + type;


});

let carrito = $('#carrito');

carrito.click(() => {

    location.href = 'https://hotelgdfree.epizy.com/?carrito';

});

let formReserva = document.getElementById("formReserva");

if (formReserva !== null) {
    formReserva.addEventListener("submit", function (event) {
        // Prevenir que el formulario se envíe automáticamente
        event.preventDefault();

        // Validar el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            let fechaInicio = document.getElementById("fechaInicio").value;

            let fechaFin = document.getElementById("fechaFin").value;

            let id = document.getElementById("id").value;

            window.location.href = "https://hotelgdfree.epizy.com/?fechaInicio=" + fechaInicio + "&fechaFin=" + fechaFin + "&id_habitacion=" + id;

        }
    }, false);
}

let cancelar = $('#reservas');

cancelar.find('a').click((event) => {

    var type = $(event.target).closest($('a')).get(0).dataset.type;

    location.href = 'https://hotelgdfree.epizy.com/?idReserva=' + type;

});