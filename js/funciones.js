//Formulario de Contacto
let form = document.getElementById("formContacto");

//Comprobamos que el formulario no es nulo
if (form !== null) {

    //Accedemos al formulario para controlar cuando se envía
    document.getElementById("formContacto").addEventListener("submit", function (event) {

        //Prevenimos que el formulario se envíe automáticamente
        event.preventDefault();

        //Validamos el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            //En el caso de que el formulario cumpla con sus patrones, obtenemos sus datos
            let nombre = document.getElementById("nombre").value;
            let correo = document.getElementById("correo").value;
            let telefono = document.getElementById("telefono").value;
            let mensaje = document.getElementById("mensaje").value;

            //Mandamos los datos del formulario al servidor mediante una petición AJAX
            $.ajax({
                url: "peticiones.php?tipo=contacto",
                type: "POST",
                data: {
                    nombre: nombre,
                    correo: correo,
                    telefono: telefono,
                    mensaje: mensaje
                },
                success: function (response) {
                    //Comprobamos si se ha recibido respuesta por parte del servidor
                    if (response.exists) {

                        //Si se ha realizado la consulta correctamente, mostramos el modal de mensaje enviado
                        if (response.exists == "conseguido") {
                            $('#miModal').modal('show');

                            //En el caso de que se pinche en cerrar el modal, lo cerramos
                            let cerrar = document.getElementById("cerrar");

                            cerrar.addEventListener("click", function () {

                                window.location.href = "https://hotelgdfree.epizy.com/";

                            })
                        }

                    } else {
                    }
                },
                error: function () {
                }
            });

        }
    }, false);
}

//Formulario de Sesión
let formSesion = document.getElementById("formSesion");

//Comprobamos que el formulario no es nulo
if (formSesion !== null) {

    //Accedemos al formulario para controlar cuando se envía
    formSesion.addEventListener("submit", function (event) {

        //Prevenimos que el formulario se envíe automáticamente
        event.preventDefault();

        //Validamos el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            //Recogemos los datos que envía el formulario
            let usuario = document.getElementById("usuario").value;
            let password = document.getElementById("password").value;

            //Implementamos una petición ajax para enviar los datos al servidor y devolver respuesta
            $.ajax({
                url: "peticiones.php?tipo=sesion",
                type: "POST",
                data: {
                    usuario: usuario,
                    password: password
                },
                success: function (response) {
                    if (response.exists) {

                        //Comprobamos si se ha podido hacer login correctamente
                        if (response.exists === "loginIncorrecto") {
                            window.location.href = "https://hotelgdfree.epizy.com/?loginIncorrecto";
                        } else {
                            window.location.href = "https://hotelgdfree.epizy.com/?usuario=" + response.exists;
                        }

                    } else {
                    }
                },
                error: function () {
                }
            });

        }
    }, false);
}

//Formulario de Registro
let formRegistro = document.getElementById("formRegistro");

//Comprobamos que el formulario no es nulo
if (formRegistro !== null) {

    //Accedemos al formulario para controlar cuando se envía
    formRegistro.addEventListener("submit", function (event) {
        //Prevenimos que el formulario se envíe automáticamente
        event.preventDefault();

        //Validamos el formulario
        if (this.checkValidity() === false) {
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {

            //Recogemos los datos que devuelve el formulario
            let nombre = document.getElementById("nombre").value;
            let apellido = document.getElementById("apellido").value;
            let usuario = document.getElementById("usuario").value;
            let password = document.getElementById("password").value;
            let email = document.getElementById("email").value;

            //Implementamos una petición ajax para enviar los datos al servidor y devolver respuesta
            $.ajax({
                url: "peticiones.php?tipo=registro",
                type: "POST",
                data: {
                    nombre: nombre,
                    apellido: apellido,
                    usuario: usuario,
                    password: password,
                    email: email
                },
                success: function (response) {

                    if (response.exists) {

                        //Comprobamos si se ha podido realizar el registro correctamente
                        if (response.exists === "no registrado") {
                            window.location.href = "https://hotelgdfree.epizy.com/?esta=no registrado";
                        } else {
                            window.location.href = "https://hotelgdfree.epizy.com/?esta=registrado";
                        }

                    } else {

                    }
                },
                error: function () {
                }
            });

        }
    }, false);
}

//Comprobamos si hemos pulsado el carrito
let carrito = $('#carrito');

carrito.click(() => {

    location.href = 'https://hotelgdfree.epizy.com/?carrito';

});

//Comprobamos si hemos pulsado en cancelar la reserva
let cancelar = $('#reservas');

cancelar.find('a').click((event) => {

    //Obtenemos el id de la reserva a cancelar
    var type = $(event.target).closest($('a')).get(0).dataset.type;

    main = $("#main");

    main.append(`<div class="modal fade show" id="modalConfirmacionCancelacionReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Confirmación</h5>
                        </div>
                        <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                            Deseas cancelar la reserva?
                            <br>
                            <br>
                            <img src="../images/duda2.png" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="si">Si</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="no">No</button>
                        </div>
                    </div>
                </div>
            </div>`);

    //Mostramos el modal
    $('#modalConfirmacionCancelacionReserva').modal('show');

    //Si le damos a si, mandamos el id de la reserva al servidor para que la borre
    let si = document.getElementById('si');

    si.addEventListener('click', function () {

        $.ajax({
            url: "peticiones.php?tipo=cancelarReserva",
            type: "POST",
            data: { type: type },
            success: function (response) {

                if (response.exists) {

                    location.href = 'https://hotelgdfree.epizy.com/?idReserva';

                } else {
                }
            },
            error: function () {
            }
        });

    })

    //Si le damos a no, no borramos la reserva
    let no = document.getElementById('no');

    no.addEventListener('click', function () {

        window.location.href = 'https://hotelgdfree.epizy.com/?carrito';

    })

});