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

                window.location.href = "http://localhost/DWES/ProyectoFinDeGrado/ProyectoFinDeGrado-1/php/inicio.php";

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

            // window.location.href = "http://localhost/DWES/ProyectoFinDeGrado/ProyectoFinDeGrado-1/php/inicio.php?sesion&usuario=" + usuario + "&password=" + password;
            window.location.href = "http://localhost/DWES/ProyectoFinDeGrado/ProyectoFinDeGrado-1/php/inicio.php?sesion&usuario=" + usuario + "&password=" + password;

            // Si el formulario es válido, abrir el modal
            // $('#modalSesion').modal('show');

            // let cerrar = document.getElementById("cerrar");

            // cerrar.addEventListener("click", function () {

            //     window.location.href = "http://localhost/DWES/ProyectoFinDeGrado/ProyectoFinDeGrado-1/php/inicio.php";

            // })

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

            // Si el formulario es válido, abrir el modal
            $('#modalRegistro').modal('show');

            let cerrar = document.getElementById("cerrar");

            cerrar.addEventListener("click", function () {

                window.location.href = "http://localhost/DWES/ProyectoFinDeGrado/ProyectoFinDeGrado-1/php/inicio.php?nombre=" + nombre + "&apellido=" + apellido + "&usuario=" + usuario + "&password=" + password + "&email=" + email + "&telefono=" + telefono + "";

            })

        }
    }, false);
}







