<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel GD</title>

    <link rel="stylesheet" href="../css/estilos.css">

    <!-- Carga los archivos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="../images/logo.jpg">


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

    $controller->mostrarServicios();

    echo "</main>";

    $controller->mostrarFooter();

    //En el caso de que le demos a la sección de contacto, borramos todo y mostramos el formulario de contacto
    if (isset($_GET['contacto'])) {

        $controller->borrarHeader();

        $controller->borrarMain();

        $controller->borrarFooter();

        $controller->mostrarFormularioContacto();

        $controller->mostrarModalContacto();
    }

    //En el caso de que le demos a la sección de habitaciones, borramos todo y mostramos las habitaciones disponibles
    if (isset($_GET['habitaciones'])) {

        $controller->borrarMain();

        echo "<script>

            main = $('#main');

            main.append(`<section class='intro d-flex justify-content-center mt-5'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12'>
                        <h1 class='d-flex justify-content-center'>Habitaciones</h1>
                        <p class='d-flex justify-content-center centered-text'>En esta sección se pueden observar las habitaciones disponibles de nuestro hotel</p>
                    </div>
                </div>
            </div>
        </section>

            `);
        </script>";

        //Añadimos al main las habitaciones disponibles
        $controller->disponibles($db);
    }

    //Si recibimos el id específico de la habitación que se quiera reservar, mostramos sus datos
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $controller->borrarMain();

        $controller->habitacionEspecifica($db, $id);

        $controller->mostrarModalReserva();

        echo "<script>

            let boton = $('#reservar');

            boton.click(function(){
            
                $('#modalReserva').modal('show');

                let cerrar = document.getElementById('cerrar');

                cerrar.addEventListener('click', function () {

                window.location.href = 'https://hotelgdfree.epizy.com/?habitaciones';

                })
                
            });

        </script>";
    }

    //Si le damos a reservar una habitación
    if (isset($_POST['reservar'])) {
        echo "hola mundo";
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

            //Obtenemos los datos para ese usuario


            //Creamos la sesión con los datos de ese usuario
            $controller->crearSesion($usuario);
        }
    }

    //Si le hemos dado a registrarse
    if (isset($_GET['registrar'])) {

        $controller->borrarHeader();
        $controller->borrarMain();
        $controller->borrarFooter();

        $controller->formularioRegistro();

        $controller->modalRegistro();
    }

    if (isset($_SESSION['cliente'])) {

        // Recuperar el valor de la variable de sesión
        $nombre_usuario = $_SESSION['cliente']['usuario'];

        $email = $_SESSION['cliente']['email'];

        echo $nombre_usuario; // Esto imprimirá "Juan"

        echo $email;
    }
    //  else {
    //     echo 'La sesión no está iniciada.';
    // }

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

    ?>

    <!-- Carga los archivos JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../js/funciones.js"></script>


</body>

</html>