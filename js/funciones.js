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

            $.ajax({
                url: "peticiones.php?tipo=sesion", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                type: "POST",
                data: { usuario: usuario, 
                    password: password
                },
                success: function (response) {
                    console.log(response)
                    if (response.exists) {
            
                        console.log(response.exists);

                        if (response.exists === "loginIncorrecto"){
                            window.location.href = "https://hotelgdfree.epizy.com/?loginIncorrecto";
                        }else{
                            window.location.href = "https://hotelgdfree.epizy.com/?usuario=" + response.exists;
                        }

                    } else {
                        console.log("esta mal")
                    }
                },
                error: function () {
                }
            });

            // window.location.href = "https://hotelgdfree.epizy.com/?sesion&usuario=" + usuario + "&password=" + password;

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
            let apellido = '';
            let usuario = document.getElementById("usuario").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;
            let telefono = '999999999';

            $.ajax({
                url: "peticiones.php?tipo=registro", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                type: "POST",
                data: {nombre: nombre, 
                    apellido: apellido,
                    usuario: usuario, 
                    password: password, 
                    email: email, 
                    telefono: telefono
                },
                success: function (response) {
                    console.log(response)
                    if (response.exists) {
            
                        if (response.exists === "no registrado"){
                            window.location.href = "https://hotelgdfree.epizy.com/?esta=no registrado";
                        }else{
                            window.location.href = "https://hotelgdfree.epizy.com/?esta=registrado";
                        }

                    } else {
                        console.log("esta mal")
                    }
                },
                error: function () {
                }
            });

            // window.location.href = "https://hotelgdfree.epizy.com/?nombre=" + nombre + "&apellido=" + apellido + "&usuario=" + usuario + "&password=" + password + "&email=" + email + "&telefono=" + telefono + "";

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




