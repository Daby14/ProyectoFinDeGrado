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

//Obtener el id de una habitación específica
let especifica = $('#habitacionesDisponibles');

especifica.find('a').click((event) => {

    var type = $(event.target).closest($('a')).get(0).dataset.type;

    console.log(type);

    $.ajax({
        url: 'pruebaJSON.php?tipo=id', // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
        type: 'POST',
        data: { type: type },
        success: function (response) {
            // console.log(response)
            if (response.exists) {
                // console.log("el correo ya existe")
                // El correo electrónico ya está en uso
                // showFeedBack($(form.email), false, 'El correo electrónico ya está en uso');

                $("#main").empty();

                $("#main").append(`
                <div class="container py-5">
                    <div id="habitacionEspecifica">
                
                    </div>
                </div>`);

                for (let i = 0; i < response.exists.length; i += 6) {
                    // console.log(response.exists[i]);

                    let especifica = $("#habitacionEspecifica");

                    especifica.append(`

                    <div class="card mb-5 w-100 noReserva">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="data:image/jpg;base64,${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                            </div>
                            <div class="col-md-7" style="display:block; margin:auto;">
                                <div class="card-body" id="prueba7">
                                    <h5 class="card-title">${response.exists[i + 1]}</h5>
                                    <p class="card-text">${response.exists[i + 2]}€/noche</p>
                                    <p class="card-text">${response.exists[i + 3]}</p>
                                    <p class="card-text">${response.exists[i + 4]}</p>
                                    <button id="reservar" class="btn btn-primary">Reservar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    `);

                    let boton = $('#reservar');

                    boton.click(function () {

                        // $('#modalReserva').modal('show');

                        // let cerrar = document.getElementById('cerrar');

                        // cerrar.addEventListener('click', function () {

                        window.location.href = `https://hotelgdfree.epizy.com/?reservar&id_habitacion=${response.exists[i + 5]}`;

                        // })

                    });

                }



            } else {
                console.log("esta mal")
            }
        },
        error: function () {
        }
    });

    // location.href = 'https://hotelgdfree.epizy.com/?id=' + type;

});

//Si le damos a reservar


//Comprobamos si hemos pulsado el carrito
let carrito = $('#carrito');

carrito.click(() => {

    location.href = 'https://hotelgdfree.epizy.com/?carrito';

});

//Formulario de Reserva
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

//Obtenemos el id de la reserva a cancelar
let cancelar = $('#reservas');

cancelar.find('a').click((event) => {

    var type = $(event.target).closest($('a')).get(0).dataset.type;

    location.href = 'https://hotelgdfree.epizy.com/?idReserva=' + type;

    $('#modalConfirmacionCancelacionReserva').modal('show');

});