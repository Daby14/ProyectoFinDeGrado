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

    // var formData = new FormData();
    // formData.append('type', type);

    // fetch('post.php',{
    //     method: 'POST',
    //     body: formData
    // }).then(res => res.json())
    // .then(data => {
    //     console.log(data);
    // })

    // Dato a enviar al servidor
    // var dato = 5;

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

    $('#modalCancelarReserva').modal('show');

    let cerrar = document.getElementById("cerrar");

    cerrar.addEventListener("click", function () {

        window.location.href = "https://hotelgdfree.epizy.com/";

    })

});

// this.main.append($('<div class="container"><div class="m-4" id="mapid"></div></div>'));
//         let mapContainer = $('#mapid');
//         mapContainer.css({
//             height: '350px',
//             border: '2px solid #faa541'
//         });

//         let map = L.map('mapid')
//             .setView([product.locations.latitude, product.locations.longitude], 15);

//         L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//             attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
//             maxZoom: 18
//         }).addTo(map);

//         let marker = L.marker([product.locations.latitude, product.locations.longitude]).addTo(map);

// var dato = {
//     nombre: 'John',
//     edad: 30,
//     ciudad: 'New York'
// };

// fetch('index.php', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/json'
//     },
//     body: JSON.stringify(dato)
// })
//     .then(function (response) {
//         return response.text();
//     })
//     .then(function (resultado) {
//         console.log(resultado);
//     });


