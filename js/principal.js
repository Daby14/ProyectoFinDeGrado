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

            window.location.href = "http://127.0.0.1:5500/index.html";

        })

    }
}, false);

