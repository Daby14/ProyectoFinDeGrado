<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel GD</title>

    <link rel="stylesheet" href="../css/estilos.css">

    <!-- Carga los archivos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" type="image/jpg" href="../images/favicon.jpg">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

</head>

<body class="pruebaDavid">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php

    session_start();

    require_once("controlador.php");

    $db = new DB("epiz_34160839_hotelgd");

    $controller = new Controller();

    //Página principal
    $controller->mostrarCabecera();

    echo "<main id='main'>";

    $controller->mostrarIntroduccion();

    $controller->mostrarCarousel();

    $controller->mostrarTipoHabitacion();

    $controller->mostrarServicios();

    $controller->opiniones();

    $controller->mostrarMapa();

    echo "</main>";

    $controller->mostrarFooter();

    //En el caso de que le demos a la sección de contacto, borramos todo y mostramos el formulario de contacto
    if (isset($_SESSION['cliente']) && isset($_GET['contacto'])) {

        $controller->borrarHeader();

        $controller->borrarMain();

        $controller->borrarFooter();

        $controller->mostrarFormularioContacto();

        $controller->mostrarModalContacto();
        // $controller->modalPruebaFondo();

    } else if (isset($_GET['contacto'])) {

        $controller->modalContactoNoDisponible();

        echo "<script>

            $(document).ready(function() {
                $('#modalContactoNoDisponible').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/';

                })
            });

        </script>";
    }

    // if (isset($_GET['reservar']) && isset($_GET['id_habitacion'])) {

    //     $id = $_GET['id_habitacion'];

    //     $controller->borrarHeader();
    //     $controller->borrarFooter();
    //     $controller->borrarMain();

    //     $controller->formularioReserva();

    //     echo "<script>

    //         main = $('#main');

    //         main.append(`<input id='id' type='hidden' name='id' value='$id'></input>`);

    //     </script>";
    // }

    // if (isset($_GET['fechaInicio']) && isset($_GET['fechaFin']) && isset($_GET['id_habitacion'])) {

    //     $fechaInicio = $_GET['fechaInicio'];
    //     $fechaFin = $_GET['fechaFin'];
    //     $id_habitacion = $_GET['id_habitacion'];
    //     $usuario = $_SESSION['cliente']['usuario'];

    //     //En el caso de que la fecha de inicio sea menor que la actual, se repite el proceso de reserva
    //     date_default_timezone_set('Europe/Madrid');

    //     $fecha = date('Y-m-d');

    //     //En el caso de que la fecha de fin sea menor o igual que la de inicio se repite el proceso de reserva

    //     //Si la fecha es menor, repetimos el proceso de reserva
    //     if (($fechaInicio < $fecha) || ($fechaFin <= $fechaInicio)) {

    //         $controller->modalFalloReserva();

    //         echo "<script>

    //             $(document).ready(function () {
    //                 $('#modalFalloReserva').modal('show');

    //                 let cerrar = document.getElementById('cerrar');

    //                 cerrar.addEventListener('click', function () {

    //                     window.location.href = 'https://hotelgdfree.epizy.com/';

    //                 })
    //             });

    //         </script>";
    //     } else {
    //         $controller->reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion);

    //         $controller->modalReservaConfirmacion();

    //         echo "<script>

    //             $(document).ready(function () {
    //                 $('#modalReservaConfirmacion').modal('show');

    //                 let cerrar = document.getElementById('cerrar');

    //                 cerrar.addEventListener('click', function () {

    //                     window.location.href = 'https://hotelgdfree.epizy.com/';

    //                 })
    //             });

    //         </script>";
    //     }
    // }

    // if (isset($_GET['idReserva']) && isset($_GET['confirmacion'])) {

    //     $controller->modalCancelarReserva();

    //     echo "<script>

    //         $(document).ready(function() {
    //             $('#modalCancelarReserva').modal('show');

    //             let cerrar = document.getElementById('cerrar');

    //             cerrar.addEventListener('click', function () {

    //             window.location.href = 'https://hotelgdfree.epizy.com/';

    //             })
    //         });

    //     </script>";
    if (isset($_GET['idReserva'])) {

        $controller->modalCancelarReserva();

        echo "<script>

        $(document).ready(function() {
            $('#modalCancelarReserva').modal('show');

            let cerrar = document.getElementById('cerrar');

            cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/';

            })

        });

        </script>";
    }

    //Si le damos a iniciar sesión
    if (isset($_GET['sesion'])) {

        $controller->borrarHeader();
        $controller->borrarMain();
        $controller->borrarFooter();

        $controller->formularioSesion();

        $controller->modalSesion();

        //Si le damos a registrarse
        echo "<script>

            let boton = $('#registrar');

            boton.click(function(){

                window.location.href = 'https://hotelgdfree.epizy.com/?registrar';

            });

        </script>";
    } else {
        if (isset($_GET['cerrarSesion'])) {

            $controller->cerrarSesion();
        }
    }

    //Si se ha hecho login correctamente, recibimos el usuario
    if (isset($_GET['usuario'])) {

        //Lo obtenemos de la url
        $usuario = $_GET['usuario'];

        //Creamos la sesión con los datos de ese usuario
        $controller->crearSesion($usuario);
    }

    if (isset($_GET['loginIncorrecto'])) {

        //Llamar al modal de login incorrecto
        $controller->modalLoginIncorrecto();

        echo '<script>

        $(document).ready(function() {
            $("#modalLoginIncorrecto").modal("show");

            let cerrar = document.getElementById("cerrar");

            cerrar.addEventListener("click", function () {

            window.location.href = "https://hotelgdfree.epizy.com/?sesion";

            })
        });

        </script>';
    }

    //Si le hemos dado a registrarse
    if (isset($_GET['registrar'])) {

        $controller->borrarHeader();
        $controller->borrarMain();
        $controller->borrarFooter();

        $controller->formularioRegistro();

        $controller->modalRegistro();
    }

    //Si se recibe la variable esta
    if (isset($_GET['esta'])) {

        $esta = $_GET['esta'];

        if ($esta == 'registrado') {
            //Modal de registrado correctamente
            $controller->modalRegistro();

            echo "<script>

            $(document).ready(function() {
                $('#modalRegistro').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/';

                })
            });

        </script>";
        } else {
            //Modal de no registrado
            $controller->modalNoRegistro();

            echo "<script>

            $(document).ready(function() {
                $('#modalNoRegistro').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/?registrar';

                })
            });

        </script>";
        }
    }

    if (isset($_GET['carrito']) && isset($_SESSION['cliente'])) {

        $controller->borrarMain();

        $usuario = $_SESSION['cliente']['usuario'];

        //Obtenemos los datos para ese usuario
        $controller->datosUsuarioLogin($db, $usuario);
    } else if (isset($_GET['carrito'])) {
        $controller->modalCarrito();

        echo "<script>

            $(document).ready(function() {
                $('#modalCarrito').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/';

                })
            });

        </script>";
    }

    $controller->actualizarReservas($db);

    //Si se recibe la sesión cliente le añado el id a la sección de habitaciones
    if (isset($_SESSION['cliente']) && isset($_GET['habitacionesHotel'])) {

        $usuario = $_SESSION['cliente']['usuario'];

        if ($usuario == "admin" || $usuario == "Admin") {
            echo '<script>

            $("#main").empty();

            $("#main").append(`
            <div id="tituloHabitacionSeleccionada" style="margin-top:50px; margin-bottom:130px;">
                <h1 class="noReserva">ACCEDIENDO A LAS HABITACIONES DEL HOTEL</h1>
            </div>
            <div id="loader" style="margin-bottom:100px;"></div>`);

            setTimeout(function() {
                $.ajax({
                    url: "peticiones.php?tipo=habitaciones", 
                    type: "POST",
                    data: { type: "Disponible" },
                    success: function (response) {
                        
                        if (response.exists) {
                
                            main = $("#main");
    
                            main.empty();
                
                            main.append(`
                                <h4 class="noReserva mt-5 mb-2">Habitaciones Disponibles</h4>
    
                                <div class="noReserva mt-5 mb-3" id="agregaHabitaciones">
                                
                                    <a href="https://hotelgdfree.epizy.com?agregaHabitacion" class="btn btn-primary">Agregar Habitacion</a>
    
                                </div>
    
                                <form id="formulario">
                                    <div class="container py-5">
                                        <div id="habitacionesDisponibles" class="card-columns2">
                
                                        </div>
                                    </div>
                                </form>`);
                
                            for (let i = 0; i < response.exists.length; i += 6) {
                
                                disponibles = $("#habitacionesDisponibles");
                
                                disponibles.append(`
                
                                    <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                                        <div class="row g-0">
                                            <div class="col-md-5">
                                                <img src="../images/${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                                            </div>
                                            <div class="col-md-7" style="display:block; margin:auto;">
                                                <div class="card-body">
                                                    <h4 class="card-title text-light">${response.exists[i + 1]}</h4>
                                                    <br>
                                                    <br>
                                                    <a id="pruebaEnlace" href="https://hotelgdfree.epizy.com/?habitacionEspecificaHotel&id=${response.exists[i + 5]}" class="btn btn-light" data-type=" ${response.exists[i + 5]} ">Ver mas</a>
                                                    <a href="https://hotelgdfree.epizy.com/?actualizarHabitacion=${response.exists[i + 5]}" class="btn btn-light">Actualizar</a>
                                                    <a href="https://hotelgdfree.epizy.com/?borrarHabitacion=${response.exists[i + 5]}" class="btn btn-light">Borrar</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
                            }
    
                            
    
                        } else {
                            console.log("esta mal")
                        }
                    },
                    error: function () {
                    }
                });
            }, 1000);


            </script>';
        } else {
            echo '<script>

            $("#main").empty();

            $("#main").append(`
            <div id="tituloHabitacionSeleccionada" style="margin-top:50px; margin-bottom:130px;">
                <h1 class="noReserva">ACCEDIENDO A LAS HABITACIONES DEL HOTEL</h1>
            </div>
            <div id="loader" style="margin-bottom:100px;"></div>`);

            setTimeout(function() {
                $.ajax({
                    url: "peticiones.php?tipo=habitaciones", 
                    type: "POST",
                    data: { type: "Disponible" },
                    success: function (response) {
                        
                        if (response.exists) {
                
                            main = $("#main");
    
                            main.empty();
                
                            main.append(`
                                <h4 class="noReserva mt-5 mb-2">Habitaciones Disponibles</h4>
    
                                <div class="noReserva mt-3 mb-3" id="agregaHabitaciones">
                                
    
    
                                </div>
    
                                <form id="formulario">
                                    <div class="container py-5">
                                        <div id="habitacionesDisponibles" class="card-columns2">
                
                                        </div>
                                    </div>
                                </form>`);
                
                            for (let i = 0; i < response.exists.length; i += 6) {
                
                                disponibles = $("#habitacionesDisponibles");
                
                                disponibles.append(`
                
                                    <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                                        <div class="row g-0">
                                            <div class="col-md-5">
                                                <img src="../images/${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                                            </div>
                                            <div class="col-md-7" style="display:block; margin:auto;">
                                                <div class="card-body">
                                                    <h4 class="card-title text-light">${response.exists[i + 1]}</h4>
                                                    <br>
                                                    <br>
                                                    <a id="pruebaEnlace" href="https://hotelgdfree.epizy.com/?habitacionEspecificaHotel&id=${response.exists[i + 5]}" class="btn btn-light" data-type=" ${response.exists[i + 5]} ">Ver mas</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);
                            }
    
                            
    
                        } else {
                            console.log("esta mal")
                        }
                    },
                    error: function () {
                    }
                });
            }, 1000);


            

            </script>';
        }

        //Si se recibe la sesión hago la petición de habitaciones para mostrar las habitaciones disponibles


    } else if (isset($_GET['habitacionesHotel'])) {
        $controller->modalHabitacionesNoDisponibles();

        echo "<script>

            $(document).ready(function() {
                $('#modalHabitacionesNoDisponibles').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/';

                })
            });

        </script>";
    }

    if (isset($_SESSION['cliente']) && isset($_GET['habitacionEspecificaHotel']) && isset($_GET['id'])) {

        $id = $_GET['id'];

        $usuario = $_SESSION['cliente']['usuario'];

        if ($usuario == "admin" || $usuario == "Admin") {

            echo '<script>

            $("#main").empty();

            $("#main").append(`
            <div id="tituloHabitacionSeleccionada" style="margin-top:50px; margin-bottom:130px;">
                <h1 class="noReserva">ACCEDIENDO A LA HABITACIÓN SELECCIONADA</h1>
            </div>
            <div id="loader" style="margin-bottom:100px;"></div>`);

            setTimeout(function() {
                $.ajax({
                    url: "peticiones.php?tipo=id", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                    type: "POST",
                    data: { type: ' . $id . ' },
                    success: function (response) {
                        // console.log(response)
                        if (response.exists) {
                            // console.log("el correo ya existe")
                            // El correo electrónico ya está en uso
                            // showFeedBack($(form.email), false, "El correo electrónico ya está en uso");
    
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
    
                                <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <img src="../images/${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                                        </div>
                                        <div class="col-md-7" style="display:block; margin:auto;">
                                            <div class="card-body" id="prueba7">
                                                <h5 class="card-title text-light">${response.exists[i + 1]}</h5>
                                                <p class="card-text text-light">${response.exists[i + 2]}€/noche</p>
                                                <p class="card-text text-light">${response.exists[i + 3]}</p>
                                                <p class="card-text text-light">${response.exists[i + 4]}</p>
                                                <a class="btn btn-light" href="https://hotelgdfree.epizy.com/?habitacionesHotel">Volver</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                `);
    
                            }
    
                        } else {
                            console.log("esta mal")
                        }
                    },
                    error: function () {
                    }
                });
            }, 1000);

        
            

            
            </script>';

        }else{
            echo '<script>

            $("#main").empty();

            $("#main").append(`
            <div id="tituloHabitacionSeleccionada" style="margin-top:50px; margin-bottom:130px;">
                <h1 class="noReserva">ACCEDIENDO A LA HABITACIÓN SELECCIONADA</h1>
            </div>
            <div id="loader" style="margin-bottom:100px;"></div>`);

            setTimeout(function() {
                
                $.ajax({
                    url: "peticiones.php?tipo=id", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                    type: "POST",
                    data: { type: ' . $id . ' },
                    success: function (response) {
                        // console.log(response)
                        if (response.exists) {
                            // console.log("el correo ya existe")
                            // El correo electrónico ya está en uso
                            // showFeedBack($(form.email), false, "El correo electrónico ya está en uso");
    
                            // $("#main").empty();
    
                            $("#tituloHabitacionSeleccionada").hide();
                            $("#loader").hide();
    
                            $("#main").append(`
                            <div class="container py-5">
                                <div id="habitacionEspecifica">
    
                                </div>
                            </div>`);
    
                            for (let i = 0; i < response.exists.length; i += 6) {
                                // console.log(response.exists[i]);
    
                                let especifica = $("#habitacionEspecifica");
    
                                especifica.append(`
    
                                <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <img src="../images/${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                                        </div>
                                        <div class="col-md-7" style="display:block; margin:auto;">
                                            <div class="card-body" id="prueba7">
                                                <h5 class="card-title text-light">${response.exists[i + 1]}</h5>
                                                <p class="card-text text-light">${response.exists[i + 2]}€/noche</p>
                                                <p class="card-text text-light">${response.exists[i + 3]}</p>
                                                <p class="card-text text-light">${response.exists[i + 4]}</p>
                                                <a id="reservar" href="https://hotelgdfree.epizy.com/?reservaHabitacion&id=' . $id . '" class="btn btn-light" data-type=" ${response.exists[i + 5]} ">Reservar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                `);
    
                            }
    
                        } else {
                            console.log("esta mal")
                        }
                    },
                    error: function () {
                    }
                });

            }, 1000);
            

            
            </script>';
        }

        
    }

    if (isset($_SESSION['cliente']) && isset($_GET['reservaHabitacion']) && $_GET['id']) {

        $id = $_GET['id'];
        $usuario = $_SESSION['cliente']['usuario'];

        $usuario = "\"$usuario\"";

        echo '<script>
        
        // let boton = $("#habitacionEspecifica");

        // boton.find("a").click(function (event) {

        //     var type = $(event.target).closest($("a")).get(0).dataset.type;

        //     console.log(type);

            //window.location.href = `https://hotelgdfree.epizy.com/?reservar&id_habitacion=${response.exists[i + 5]}`;

            $("#main").empty();

            $("#main").append(`
            <div id="tituloHabitacionSeleccionada" style="margin-top:50px; margin-bottom:130px;">
                <h1 class="noReserva">ACCEDIENDO AL FORMULARIO DE RESERVA</h1>
            </div>
            <div id="loader" style="margin-bottom:100px;"></div>`);

            setTimeout(function() {
                $.ajax({
                    url: "peticiones.php?tipo=idEspecifico", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                    type: "POST",
                    data: { type: ' . $id . ' },
                    success: function (response) {
                        console.log(response)
                        if (response.exists) {
    
                            let body = document.body;
    
                            body.classList.add("formuContacto");
    
                            body.id = "login";
    
                            header = $("#header");
    
                            header.empty();
    
                            footer = $("#footer");
    
                            footer.empty();
    
                            main = $("#main");
    
                            main.empty();
    
                            main.append(`<div class="wrapper bg-white">
                            <div class="h2 text-center tituloLogin">Hotel GD</div>
                            <div class="h4 text-muted text-center pt-2 subtituloLogin">Reserva</div>
                            <form id="formReserva" class="needs-validation" novalidate>
                                <div class="form-group">
                                    
                                    <label for="fechaInicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control" id="fechaInicio" placeholder="Ingrese la fecha de inicio" required>
                                    <div class="valid-feedback">
                                        ¡Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        La fecha de inicio es obligatoria
                                    </div>
            
                                </div>
            
                                <div class="form-group">
                                    
                                    <label for="fechaFin" class="mt-3">Fecha de Fin:</label>
                                    <input type="date" class="form-control" id="fechaFin" placeholder="Ingrese la fecha de fin" required>
                                    
                                    <div class="valid-feedback">
                                            ¡Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                            La fecha de fin es obligatoria
                                    </div>
                                </div>
                                <div class="d-flex align-items-start">
                                    <div class="ml-auto"> </div>
                                </div> 
                                <button type="submit" class="btn btn-block text-center my-3" id="confirmarReserva" data-toggle="modal" data-target="#exampleModal">Confirmar Reserva</button>
                                <a href="https://hotelgdfree.epizy.com/" class="btn btn-block text-center my-3">Volver</a>
                            </form>
                        </div>`);
    
                            let formReserva = document.getElementById("formReserva");
    
                            if (formReserva !== null) {
                                formReserva.addEventListener("submit", function (event) {
                                    // Prevenir que el formulario se envíe automáticamente
                                    event.preventDefault();
    
                                    // Validar el formulario
                                    if (this.checkValidity() === false) {
                                        event.stopPropagation();
                                        this.classList.add("was-validated");
                                    } else {
    
                                        // let usuario = ' . $usuario . ';
    
                                        // console.log(usuario);
    
                                        let fechaInicio = document.getElementById("fechaInicio").value;
    
                                        let fechaFin = document.getElementById("fechaFin").value;
    
                                                $.ajax({
                                                    url: "peticiones.php?tipo=reserva", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                                                    type: "POST",
                                                    data: {fechaInicio: fechaInicio, 
                                                        fechaFin: fechaFin,
                                                        id: ' . $id . ',
                                                        usuario: ' . $usuario . '
                                                    },
                                                    success: function (response) {
                                                        // console.log(response)
                                                        if (response.exists) {
                                                
                                                            if (response.exists === "fallo"){
                                                                
                                                                main = $("#main");
    
                                                                main.append(`<div class="modal fade show" id="modalFalloReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Fallo Reserva</h5>
                                                                            </div>
                                                                            <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                                                La reserva no se pudo realizar correctamente. La fecha de inicio no puede ser anterior al día de hoy y la fecha de fin debe de ser mayor que la de inicio
                                                                                <br>
                                                                                <br>
                                                                                <img src="../images/reservaFallida.jpg" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
    
                                                                $("#modalFalloReserva").modal("show");
                                            
                                                                let cerrar = document.getElementById("cerrar");
                                                
                                                                cerrar.addEventListener("click", function () {
                                                
                                                                    window.location.href = "https://hotelgdfree.epizy.com/";
                                                
                                                                })
    
                                                            }else{
                                                                main = $("#main");
            
                                                                main.append(`<div class="modal fade show" id="modalReservaConfirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Confirmación de Reserva</h5>
                                                                            </div>
                                                                            <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                                                Se ha reservado correctamente la habitación. Muchas gracias por confiar en nuestro hotel
                                                                                <br>
                                                                                <img src="../images/reservaConfirmada.jpg" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
            
                                                                $("#modalReservaConfirmacion").modal("show");
                                                
                                                                let cerrar = document.getElementById("cerrar");
                                                
                                                                cerrar.addEventListener("click", function () {
                                                
                                                                    window.location.href = "https://hotelgdfree.epizy.com/";
                                                
                                                                })
                                                            }
                                    
                                                        } else {
                                                            console.log("esta mal")
                                                        }
                                                    },
                                                    error: function () {
                                                    }
                                                });
    
                                    }
                                }, false);
                            }
    
                        } else {
                            console.log("esta mal")
                        }
                    },
                    error: function () {
                    }
                });
            }, 1000);


            

        </script>';
    }

    if (isset($_SESSION['cliente'])) {

        $usuario = $_SESSION['cliente']['usuario'];

        //Si inicia sesión el administrador tiene unos derechos exclusivos
        if (($usuario == "admin") || ($usuario == "Admin")) {

            echo '<script>
            
                $("#carrito").css({"display" : "none"});

                $("#contacto").html("Reservas");

                $("#contacto").attr("href","https://hotelgdfree.epizy.com/?reservasAdmin");

                $("#menu2").append(`
                    <li>
                        <strong><a id="contactoDatos" href="https://hotelgdfree.epizy.com/?contactoDatos" class="nav-link px-2 text-light">Mensajes</a></strong>
                    </li>`);

                $("#menu2").append(`
                    <li>
                        <strong><a id="clientesAdmin" href="https://hotelgdfree.epizy.com/?clientesAdmin" class="nav-link px-2 text-light">Clientes</a></strong>
                    </li>`);
                
                $("#menu2").append(`
                    <li>
                        <strong><a id="usuariosAdmin" href="https://hotelgdfree.epizy.com/?usuariosAdmin" class="nav-link px-2 text-light">Usuarios</a></strong>
                    </li>`);

            </script>';

            if (isset($_GET['reservasAdmin'])) {
                echo '<script>
            
                $("#main").empty();

                </script>';

                $controller->reservasAdmin($db);
                
            }

            if (isset($_GET['borrarReservaAdmin'])) {

                $id = $_GET['borrarReservaAdmin'];

                echo '<script>
                
                main = $("#main");
        
                    main.append(`
                    <div class="modal fade show" id="modalConfirmacionBorrarReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Confirmación de Borrado de la Reserva</h5>
                                </div>
                                <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                    ¿Quieres borrar la reserva?
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

                    let modal = document.getElementById("modalConfirmacionBorrarReserva");

                    modal.style.display = "block";
                                            
                    let si = document.getElementById("si");
                                            
                    si.addEventListener("click", function () {
                                            
                        window.location.href = "https://hotelgdfree.epizy.com/?borradoReservaConfirmado='.$id.'";
                                            
                    })

                    let no = document.getElementById("no");
                                            
                    no.addEventListener("click", function () {
                                            
                        window.location.href = "https://hotelgdfree.epizy.com/?reservasAdmin";
                                            
                    })
                
                </script>';

            }

            if (isset($_GET['borradoReservaConfirmado'])) {

                $id = $_GET['borradoReservaConfirmado'];

                // $controller->cancelarReserva($db, $id);
                
                echo '<script>

                $.ajax({
                    url: "peticiones.php?tipo=cancelarReservaAdmin",
                    type: "POST",
                    data: {id: '.$id.'},
                    success: function (response) {
                        if (response.exists) {
    
                            if(response.exists == "conseguido"){
                            
                                main = $("#main");

                                main.append(`
                                <div class="modal fade show" id="modalCancelarReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Reserva Eliminada</h5>
                                            </div>
                                            <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                Se ha eliminado la reserva de la habitación correctamente.
                                                <br>
                                                <br>
                                                <img src="../images/reservaCancelada.jpg" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`)

                                let modal = document.getElementById("modalCancelarReserva");

                                modal.style.display = "block";

                                let cerrar = document.getElementById("cerrar");
                                                            
                                cerrar.addEventListener("click", function () {
                                                            
                                    window.location.href = "https://hotelgdfree.epizy.com/?reservasAdmin";
                                                            
                                })
                            
                            }
    
                        } else {
                            console.log("No se ha realizado correctamente")
                        }
                    },
                    error: function () {
                    }
                });

                
                
                </script>';

            }


            if (isset($_GET['agregaHabitacion'])) {

                echo '<script>
            
                $("#header").empty();
                $("#main").empty();
                $("#footer").empty();

                let body = document.body;

                body.classList.add("formuContacto");

                body.id = "login";

                </script>';

                $controller->formularioAgregaHabitacion();

                echo '<script>
                
                let formAgregaHabitacion = document.getElementById("formAgregaHabitacion");

                if (formAgregaHabitacion !== null) {
                    formAgregaHabitacion.addEventListener("submit", function (event) {
                        //Prevenimos que el formulario se envíe automáticamente
                        event.preventDefault();

                        //Validamos el formulario
                        if (this.checkValidity() === false) {
                            event.stopPropagation();
                            this.classList.add("was-validated");
                        } else {

                            //Recogemos los datos que devuelve el formulario
                            let tipoHabitacion = document.getElementById("tipoHabitacion").value;
                            let precio = document.getElementById("precio").value;

                            let imagen = document.getElementById("img").value;
                            let nombre = imagen.substring(12);

                            console.log(nombre);

                            let descripcion = document.getElementById("descripcion").value;
                            let idHabitacion = "NULL";
                            let estado = "Disponible";

                            //Implementamos una petición ajax para enviar los datos al servidor y devolver respuesta
                            $.ajax({
                                url: "peticiones.php?tipo=agregaHabitacion",
                                type: "POST",
                                data: {
                                    idHabitacion: idHabitacion,
                                    tipoHabitacion: tipoHabitacion,
                                    precio: precio,
                                    estado: estado,
                                    imagen: nombre,
                                    descripcion: descripcion
                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response.exists) {

                                        if(response.exists == "conseguido"){
                                        
                                            main = $("#main");

                                            main.append(`<div class="modal fade show" id="modalAgregaHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Habitación Agregada</h5>
                                                        </div>
                                                        <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                            Se ha agregado la habitación correctamente
                                                            <br>
                                                            <br>
                                                            <img src="../images/agregaHabitacion.jpg" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`);

                                            $("#modalAgregaHabitacion").modal("show");
                                            
                                            let cerrar = document.getElementById("cerrar");
                                                
                                            cerrar.addEventListener("click", function () {
                                                
                                                window.location.href = "https://hotelgdfree.epizy.com/?habitacionesHotel";
                                                
                                            })
                                            
                                        }

                                    } else {
                                        console.log("No se ha realizado correctamente")
                                    }
                                },
                                error: function () {
                                }
                            });

                        }
                    }, false);
                }

                </script>';

            }

            if (isset($_GET['actualizarHabitacion'])) {

                $id = $_GET['actualizarHabitacion'];

                echo '<script>
            
                $("#header").empty();
                $("#main").empty();
                $("#footer").empty();

                let body = document.body;

                body.classList.add("formuContacto");

                body.id = "login";

                </script>';

                $controller->formularioActualizaHabitacion();

                echo '<script>
                
                let formActualizaHabitacion = document.getElementById("formActualizaHabitacion");

                if (formActualizaHabitacion !== null) {
                    formActualizaHabitacion.addEventListener("submit", function (event) {
                        //Prevenimos que el formulario se envíe automáticamente
                        event.preventDefault();

                        //Validamos el formulario
                        if (this.checkValidity() === false) {
                            event.stopPropagation();
                            this.classList.add("was-validated");
                        } else {

                            //Recogemos los datos que devuelve el formulario
                            let tipoHabitacion = document.getElementById("tipoHabitacion").value;
                            let precio = document.getElementById("precio").value;

                            let imagen = document.getElementById("img").value;
                            let nombre = imagen.substring(12);

                            console.log(nombre);

                            let descripcion = document.getElementById("descripcion").value;
                            let idHabitacion = "'.$id.'";
                            let estado = document.getElementById("estado").value;

                            //Implementamos una petición ajax para enviar los datos al servidor y devolver respuesta
                            $.ajax({
                                url: "peticiones.php?tipo=actualizaHabitacion",
                                type: "POST",
                                data: {
                                    idHabitacion: idHabitacion,
                                    tipoHabitacion: tipoHabitacion,
                                    precio: precio,
                                    estado: estado,
                                    imagen: nombre,
                                    descripcion: descripcion
                                },
                                success: function (response) {
                                    
                                    if (response.exists) {

                                        if(response.exists == "conseguido"){
                                        
                                            main = $("#main");

                                            main.append(`
                                            <div class="modal fade show" id="modalActualizacionHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Habitacion Actualizada</h5>
                                                        </div>
                                                        <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                            Se ha actualizado correctamente la habitación
                                                            <br>
                                                            <br>
                                                            <img src="../images/registro.png" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`)

                                            $("#modalActualizacionHabitacion").modal("show");
                                            
                                            let cerrar = document.getElementById("cerrar");
                                                
                                            cerrar.addEventListener("click", function () {
                                                
                                                window.location.href = "https://hotelgdfree.epizy.com/?habitacionesHotel";
                                                
                                            })
                                        
                                        }

                                    } else {
                                        console.log("No se ha realizado correctamente")
                                    }
                                },
                                error: function () {
                                }
                            });

                        }
                    }, false);
                }

                </script>';

            }

            if (isset($_GET['borrarHabitacion'])) {
                
                $id = $_GET['borrarHabitacion'];
                
                echo '<script>
                
                    $.ajax({
                        url: "peticiones.php?tipo=borrarHabitacion",
                        type: "POST",
                        data: {
                            id: '.$id.'
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.exists) {
        
                                if(response.exists == "conseguido"){
                                        
                                    main = $("#main");

                                    main.append(`<div class="modal fade show" id="modalBorraHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel" style="display: block; margin: auto; text-align: center;">Habitación Borrada</h5>
                                                </div>
                                                <div class="modal-body" style="display: block; margin: auto; text-align: center;">
                                                    Se ha borrado la habitación correctamente
                                                    <br>
                                                    <br>
                                                    <img src="../images/borraHabitacion.jpg" class="img-fluid w-50" style="display: block; margin: auto; text-align: center;"></img>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);

                                    $("#modalBorraHabitacion").modal("show");
                                    
                                    let cerrar = document.getElementById("cerrar");
                                        
                                    cerrar.addEventListener("click", function () {
                                        
                                        window.location.href = "https://hotelgdfree.epizy.com/?habitacionesHotel";
                                        
                                    })
                                    
                                }
        
                            } else {
                                console.log("No se ha realizado correctamente")
                            }
                        },
                        error: function () {
                        }
                    });
                
                </script>';
            }

            if (isset($_GET['contactoDatos'])) {
                echo '<script>
            
                $("#main").empty();

                </script>';

                $controller->contactoDatos($db);
                
            }

            if (isset($_GET['borrarMensaje'])) {

                $id_contacto = $_GET['borrarMensaje'];

                $controller->modalBorrarMensaje();

                echo '<script>
            
                $.ajax({
                    url: "peticiones.php?tipo=borrarMensaje",
                    type: "POST",
                    data: {
                        id: '.$id_contacto.'
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.exists) {
    
                            
                            if(response.exists == "conseguido"){
                            
                                $("#modalBorrarMensaje").modal("show");

                                let cerrar = document.getElementById("cerrar");
                                        
                                cerrar.addEventListener("click", function () {
                                        
                                    window.location.href = "https://hotelgdfree.epizy.com/?contactoDatos";
                                        
                                })
                            
                            }
    
                        } else {
                            console.log("No se ha realizado correctamente");
                        }
                    },
                    error: function () {
                    }
                });

                </script>';
                
            }

            if (isset($_GET['clientesAdmin'])) {
                echo '<script>
            
                $("#main").empty();

                </script>';

                $controller->clientesAdmin($db);
                
            }

            if (isset($_GET['borrarCliente'])) {

                $id_cliente = $_GET['borrarCliente'];

                $controller->modalClienteAdminBorrado();

                echo '<script>
            
                $.ajax({
                    url: "peticiones.php?tipo=borrarCliente",
                    type: "POST",
                    data: {
                        id: '.$id_cliente.'
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.exists) {
    
                            $("#modalClienteAdminBorrado").modal("show");

                                let cerrar = document.getElementById("cerrar");
                                        
                                cerrar.addEventListener("click", function () {
                                        
                                    window.location.href = "https://hotelgdfree.epizy.com/?clientesAdmin";
                                        
                            })
    
                        } else {
                            console.log("No se ha realizado correctamente");
                        }
                    },
                    error: function () {
                    }
                });

                </script>';

            }

            if (isset($_GET['usuariosAdmin'])) {
                echo '<script>
            
                $("#main").empty();

                </script>';

                $controller->usuariosAdmin($db);
                
            }

            if (isset($_GET['borrarUsuario'])) {

                $id_usuario = $_GET['borrarUsuario'];

                $controller->modalUsuarioAdminBorrado();

                echo '<script>
            
                $.ajax({
                    url: "peticiones.php?tipo=borrarUsuario",
                    type: "POST",
                    data: {
                        id: '.$id_usuario.'
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.exists) {
    
                            $("#modalUsuarioAdminBorrado").modal("show");

                                let cerrar = document.getElementById("cerrar");
                                        
                                cerrar.addEventListener("click", function () {
                                        
                                    window.location.href = "https://hotelgdfree.epizy.com/?usuariosAdmin";
                                        
                            })
    
                        } else {
                            console.log("No se ha realizado correctamente");
                        }
                    },
                    error: function () {
                    }
                });

                </script>';

            }

        } else {
        }
    }

    ?>

    <!-- Carga los archivos JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../js/funciones.js"></script>


</body>

</html>