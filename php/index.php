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
    if (isset($_GET['contacto'])) {

        $controller->borrarHeader();

        $controller->borrarMain();

        $controller->borrarFooter();

        $controller->mostrarFormularioContacto();

        $controller->mostrarModalContacto();
        // $controller->modalPruebaFondo();
    }

    //En el caso de que le demos a la sección de habitaciones, borramos todo y mostramos las habitaciones disponibles
    // if (isset($_GET['habitaciones'])) {

    //     $controller->borrarMain();

    //     echo "<script>

    //         main = $('#main');

    //         main.append(`<section class='intro d-flex justify-content-center mt-5'>
    //         <div class='container'>
    //             <div class='row'>
    //                 <div class='col-md-12'>
    //                     <h1 class='d-flex justify-content-center'>Habitaciones</h1>
    //                     <p class='d-flex justify-content-center centered-text'>En esta sección se pueden observar las habitaciones disponibles de nuestro hotel</p>
    //                 </div>
    //             </div>
    //         </div>
    //     </section>

    //         `);
    //     </script>";

    //     //Añadimos al main las habitaciones disponibles
    //     $controller->disponibles($db);
    // }

    //Si recibimos el id específico de la habitación que se quiera reservar, mostramos sus datos
    // if (isset($_GET['id']) && isset($_SESSION['cliente'])) {

    // if (isset($_GET['click']) && isset($_SESSION['cliente'])) {

    //     $id = $_GET['id'];

    //     $controller->borrarMain();

    //     // $controller->habitacionEspecifica($db, $id);

    //     // $controller->mostrarModalReserva();

    //     echo "<script>

    //         let boton = $('#reservar');

    //         boton.click(function(){

    //             // $('#modalReserva').modal('show');

    //             // let cerrar = document.getElementById('cerrar');

    //             // cerrar.addEventListener('click', function () {

    //             window.location.href = 'https://hotelgdfree.epizy.com/?reservar&id_habitacion=$id';

    //             // })

    //         });

    //     </script>";
    // } else {
    //     if (isset($_GET['click'])) {

    //         $controller->borrarMain();

    //         echo '<script>

    //         main = $("#main");

    //         main.append(`<div class="container py-5">

    //         <div class="card noReserva" style="width: 18rem;">
    //             <img src="../images/iniciarSesion.png" class="card-img-top" alt="...">
    //             <div class="card-body">
    //                 <h5 class="card-title">Iniciar Sesion</h5>
    //                 <p class="card-text">Debes iniciar sesión para poder reservar</p>
    //                 <a href="https://hotelgdfree.epizy.com/?sesion" class="btn btn-primary">Iniciar Sesion</a>
    //             </div>
    //         </div>


    //         </div>`);

    //         let footer = document.getElementById("footer");
    //         footer.style.bottom = "0";
    //         footer.style.left = "0";
    //         footer.style.right = "0";

    //         </script>';
    //     }
    // }

    if (isset($_GET['reservar']) && isset($_GET['id_habitacion'])) {

        $id = $_GET['id_habitacion'];

        $controller->borrarHeader();
        $controller->borrarFooter();
        $controller->borrarMain();

        $controller->formularioReserva();

        echo "<script>

            main = $('#main');

            main.append(`<input id='id' type='hidden' name='id' value='$id'></input>`);

        </script>";
    }

    if (isset($_GET['fechaInicio']) && isset($_GET['fechaFin']) && isset($_GET['id_habitacion'])) {

        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
        $id_habitacion = $_GET['id_habitacion'];
        $usuario = $_SESSION['cliente']['usuario'];

        //En el caso de que la fecha de inicio sea menor que la actual, se repite el proceso de reserva
        date_default_timezone_set('Europe/Madrid');

        $fecha = date('Y-m-d');

        //En el caso de que la fecha de fin sea menor o igual que la de inicio se repite el proceso de reserva


        //Si la fecha es menor, repetimos el proceso de reserva
        if (($fechaInicio < $fecha) || ($fechaFin <= $fechaInicio)) {

            $controller->modalFalloReserva();

            echo "<script>

                $(document).ready(function () {
                    $('#modalFalloReserva').modal('show');

                    let cerrar = document.getElementById('cerrar');

                    cerrar.addEventListener('click', function () {

                        window.location.href = 'https://hotelgdfree.epizy.com/';

                    })
                });

            </script>";
        } else {
            $controller->reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion);

            $controller->modalReservaConfirmacion();

            echo "<script>

                $(document).ready(function () {
                    $('#modalReservaConfirmacion').modal('show');

                    let cerrar = document.getElementById('cerrar');

                    cerrar.addEventListener('click', function () {

                        window.location.href = 'https://hotelgdfree.epizy.com/';

                    })
                });

            </script>";
        }
    }

    if (isset($_GET['idReserva']) && isset($_GET['confirmacion'])) {

        $id_reserva = $_GET['idReserva'];

        //Llamar al método de cancelar reserva
        $controller->cancelarReserva($db, $id_reserva);

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
    } else if (isset($_GET['idReserva'])) {

        $id_reserva = $_GET['idReserva'];

        $controller->modalConfirmacionCancelacionReserva();

        //Si le doy a que sí, cierra el modal, y recarga la pagina con el id de la reserva para borrarla

        //Si le doy a que no, cierra el modal, y recarga la pagina al carrito

        echo "<script>

            $(document).ready(function() {
                $('#modalConfirmacionCancelacionReserva').modal('show');

                let si = document.getElementById('si');

                si.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/?idReserva=$id_reserva&confirmacion';

                })

                let no = document.getElementById('no');

                no.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/?carrito';

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

    if (isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['usuario']) && isset($_GET['password']) && isset($_GET['email']) && isset($_GET['telefono'])) {

        $nombre = $_GET['nombre'];

        $apellido = $_GET['apellido'];

        $usuario = $_GET['usuario'];

        $password = $_GET['password'];

        $email = $_GET['email'];

        $telefono = $_GET['telefono'];

        //COMPROBAR SI EL USUARIO A REGISTRAR YA EXISTE. EN EL CASO DE QUE EXISTA DAMOS UN MENSAJE DE ERROR, Y SI NO EXISTE LO REGISTRAMOS

        $controller->registroClienteUsuario($nombre, $apellido, $usuario, $password, $email, $telefono, $db);

        // echo "<script>

        //     window.location.href = 'https://hotelgdfree.epizy.com';

        // </script>";
    } else if (isset($_GET['usuario']) && isset($_GET['password'])) {

        $usuario = $_GET['usuario'];

        $password = $_GET['password'];

        //Miramos en la BBDD
        $controller->existeUsuario($usuario, $password, $db);
    } else {

        //Si se ha hecho login correctamente, recibimos el usuario
        if (isset($_GET['usuario'])) {

            //Lo obtenemos de la url
            $usuario = $_GET['usuario'];

            //Creamos la sesión con los datos de ese usuario
            $controller->crearSesion($usuario);
        }
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

        //Si se recibe la sesión hago la petición de habitaciones para mostrar las habitaciones disponibles

        echo '<script>

        console.log("has iniciado sesión");

        $.ajax({
            url: "peticiones.php?tipo=habitaciones", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
            type: "POST",
            data: { type: "Disponible" },
            success: function (response) {
                console.log(response)
                if (response.exists) {
        
                    main = $("#main");
        
                    main.empty();
        
                    main.append(`
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
                                                            <img src="data:image/jpg;base64,${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
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

        

        </script>';
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

        echo '<script>
        
        $.ajax({
            url: "peticiones.php?tipo=id", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
            type: "POST",
            data: { type: ' . $id .' },
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
                                    <img src="data:image/jpg;base64,${response.exists[i]}" class="img-fluid rounded-start" alt="asfd">
                                </div>
                                <div class="col-md-7" style="display:block; margin:auto;">
                                    <div class="card-body" id="prueba7">
                                        <h5 class="card-title text-light">${response.exists[i + 1]}</h5>
                                        <p class="card-text text-light">${response.exists[i + 2]}€/noche</p>
                                        <p class="card-text text-light">${response.exists[i + 3]}</p>
                                        <p class="card-text text-light">${response.exists[i + 4]}</p>
                                        <a id="reservar" href="https://hotelgdfree.epizy.com/?reservaHabitacion&id='.$id.'" class="btn btn-light" data-type=" ${response.exists[i + 5]} ">Reservar</a>
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

        
        </script>';
    }

    if(isset($_SESSION['cliente']) && isset($_GET['reservaHabitacion']) && $_GET['id']){

        $id = $_GET['id'];

        echo '<script>
        
        // let boton = $("#habitacionEspecifica");

        // boton.find("a").click(function (event) {

        //     var type = $(event.target).closest($("a")).get(0).dataset.type;

        //     console.log(type);

            //window.location.href = `https://hotelgdfree.epizy.com/?reservar&id_habitacion=${response.exists[i + 5]}`;

            $.ajax({
                url: "peticiones.php?tipo=idEspecifico", // Ruta del archivo en el servidor que verifica la disponibilidad del correo electrónico
                type: "POST",
                data: { type: '.$id.' },
                success: function (response) {
                    console.log(response)
                    if (response.exists) {

                        let body = document.body;

                        body.classList.add("formuContacto");

                        header = $("#header");

                        header.empty();

                        footer = $("#footer");

                        footer.empty();

                        main = $("#main");

                        main.empty();

                        main.append(`<div class="container-fluid bg-image">
                        <div class="container bg2-form">
                            <form id="formReserva" class="needs-validation" novalidate>

                                <div class="card-header">
                                    <h4>Formulario de Reserva</h4>
                                </div>

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
                                    <label for="fechaFin">Fecha de Fin:</label>
                                    <input type="date" class="form-control" id="fechaFin" placeholder="Ingrese la fecha de fin" required>
                                    <div class="valid-feedback">
                                        ¡Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        La fecha de fin es obligatoria
                                    </div>

                                </div>
                            
                                <button id="confirmarReserva" type="submit" class="btn btn-primary mt-2" id="iniciar" data-toggle="modal" data-target="#exampleModal">Confirmar Reserva</button>
                                <a href="https://hotelgdfree.epizy.com/" class="btn btn-primary mt-2">Volver</a>
                            </form>
                        </div>
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

                                    console.log("hola");

                                    let fechaInicio = document.getElementById("fechaInicio").value;

                                    let fechaFin = document.getElementById("fechaFin").value;

                                    // let id = document.getElementById("id").value;

                                    window.location.href = "https://hotelgdfree.epizy.com/?fechaInicio=" + fechaInicio + "&fechaFin=" + fechaFin + "&id_habitacion=" + '. $id .';

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

    //     });

    // }

        </script>';

    }

    ?>

    <!-- Carga los archivos JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../js/funciones.js"></script>


</body>

</html>