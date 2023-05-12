<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel GD</title>



    <!-- Carga los archivos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="../images/logo.jpg">

</head>

<body>

    <?php

    //Operaciones con la BBDD

    require_once "LibreriaPDO.php";

    $db = new DB("epiz_34160839_hotelgd");

    class Model
    {

        public function pruebaJSON($db, $type)
        {

            // // Obtener los datos JSON enviados por la petición HTTP POST
            // $data = json_decode(file_get_contents('php://input'), true);

            // // Hacer lo que necesites con los datos recibidos
            // $type = $data['type'];

            // $param = array();
            // $param['Type'] = $type;
            // $param['Password'] = 'hola';

            $param = array();
            $param['Usuario'] = $type;

            // $consulta = "insert into usuarios values (NULL, :Type, :Password)";
            $consulta = "select id_usuario as id_usuario from usuarios where usuario=:Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_usuario = $db->filas[0]['id_usuario'];

            echo $id_usuario;
        }

        public function habitacionesDisponibles($db)
        {

            $param = array();
            $param['Estado'] = 'Disponible';

            $consulta = "select * from habitaciones where estado = :Estado";

            $db->ConsultaDatos($consulta, $param);

            echo '<script>

            main = $("#main");

            main.append(`
            <form id="formulario">
                <div class="container py-5">
                    <div id="habitacionesDisponibles" class="card-columns3">
                
                    </div>
                </div>
            </form>`);

            </script>';

            foreach ($db->filas as $fila) {

                echo '<script>

                disponibles = $("#habitacionesDisponibles");

                disponibles.append(`

                
                    <div class="card mb-5">
                        <img src="data:image/jpg;base64,' . base64_encode($fila['imagen']) . '" class="card-img-top" alt="asfd">
                        <div class="card-body">
                            <h5 class="card-title">' . $fila['tipo_habitacion'] . '</h5>
                            <br>
                            <a href="#" class="btn btn-primary" data-type=" ' . $fila['id_habitacion'] . ' ">Ver mas</a>
                        </div>
                    </div>
                

                    `);

                </script>';
            }
        }

        public function actualiza($db)
        {

            $param = array();
            $param['Estado'] = 'Ocupada';

            $consulta = "select * from habitaciones where estado = :Estado";

            $db->ConsultaDatos($consulta, $param);

            foreach ($db->filas as $fila) {

                $param = array();
                $param['Estado'] = 'Disponible';

                $consulta = "update habitaciones set estado=:Estado where id_habitacion = " . $fila['id_habitacion'] . "";
                $db->ConsultaSimple($consulta, $param);
            }
        }

        public function habitacionEspecifica($db, $id)
        {

            $param = array();
            $param['Id'] = $id;

            $consulta = "select * from habitaciones where id_habitacion = :Id";

            $db->ConsultaDatos($consulta, $param);

            echo '<script>

            main = $("#main");

            main.append(`
                <div class="container py-5">
                    <div id="habitacionEspecifica">
                
                    </div>
                </div>`);

            </script>';

            foreach ($db->filas as $fila) {

                echo '<script>

                especifica = $("#habitacionEspecifica");

                especifica.append(`

                    <div class="card mb-5">
                        <img src="data:image/jpg;base64,' . base64_encode($fila['imagen']) . '" class="card-img-top" alt="Imagen Habitacion">
                        <div class="card-body">
                            <h5 class="card-title">' . $fila['tipo_habitacion'] . '</h5>
                            <br>
                            <p class="card-text">' . $fila['descripcion'] . '</p>
                            <p class="card-text">' . $fila['estado'] . '</p>
                            <button id="reservar" class="btn btn-primary">Reservar</button>
                        </div>
                    </div>

                    `);

                </script>';
            }
        }

        public function existeUsuario($usuario, $password, $db)
        {

            $param = array();
            $param['Usuario'] = $usuario;
            $param['Password'] = $password;

            $consulta = "select count(*) as total from usuarios where usuario = :Usuario and password = :Password";

            $db->ConsultaDatos($consulta, $param);

            $total = $db->filas[0]['total'];

            if ($total == 0) {

                echo '<script>

                main = $("#main");

                main.append(`

                    <h1>Login Incorrecto</h1>

                    `);

                </script>';
            } else {
                echo '<script>

                    window.location.href = "https://hotelgdfree.epizy.com/?usuario=' . $usuario . '";

                </script>';
            }
        }

        public function registroClienteUsuario($nombre, $apellido, $usuario, $password, $email, $telefono, $db)
        {

            $param = array();
            $param['Usuario'] = $usuario;
            $consulta = "select count(*) as total from usuarios where usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $total = $db->filas[0]['total'];

            $esta = '';

            if ($total == 0) {
                $param = array();
                $param['Nombre'] = $nombre;
                $param['Apellido'] = $apellido;
                $param['Email'] = $email;
                $param['Telefono'] = $telefono;
                $param['Usuario'] = $usuario;

                $consulta = "insert into clientes values (NULL, :Nombre, :Apellido, :Email, :Telefono, :Usuario)";

                $db->ConsultaSimple($consulta, $param);

                $param = array();
                $param['Usuario'] = $usuario;
                $param['Password'] = $password;

                $consulta = "insert into usuarios values (NULL, :Usuario, :Password)";

                $db->ConsultaSimple($consulta, $param);

                $esta = 'registrado';
            } else {
                echo "ESE USUARIO YA ESTÁ REGISTRADO";
                $esta = 'no registrado';
            }

            $param = array();
            $param['Usuario'] = $usuario;
            $consulta = "select id_usuario as id_usuario from usuarios where usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_usuario = $db->filas[0]['id_usuario'];

            $param = array();
            $param['Nombre'] = $nombre;
            $param['Apellido'] = $apellido;
            $param['Usuario'] = $id_usuario;
            $consulta = "update clientes set id_usuario=:Usuario where nombre=:Nombre and apellido=:Apellido";

            $db->ConsultaSimple($consulta, $param);

            echo '<script>

                window.location.href = "https://hotelgdfree.epizy.com/?esta=' . $esta . '";

            </script>';
        }

        public function datosUsuarioLogin($db, $usuario)
        {

            $param = array();
            $param['Usuario'] = $usuario;

            $consulta = "select id_usuario as id_usuario from usuarios where usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_usuario = $db->filas[0]['id_usuario'];

            $param = array();
            $param['Cliente'] = $id_usuario;

            $consulta = "select id_cliente as id_cliente from clientes where id_usuario = :Cliente";

            $db->ConsultaDatos($consulta, $param);

            $id_cliente = $db->filas[0]['id_cliente'];

            //Comprobamos si el cliente tiene reservas
            $param = array();
            $param['Cliente'] = $id_cliente;

            $consulta = "select count(*) as total from reservas where id_cliente = :Cliente ";

            $db->ConsultaDatos($consulta, $param);

            $total = $db->filas[0]['total'];

            if ($total == 0) {
                echo '<script>

                main = $("#main");

                main.append(`
                    <div class="container py-5">

                    <div class="card noReserva" style="width: 18rem;">
                        <img src="../images/reserva.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Carrito Vacío</h5>
                            <p class="card-text">Te animamos a que reserves nuestras lujosas habitaciones.</p>
                            <a href="https://hotelgdfree.epizy.com/?habitaciones" class="btn btn-primary">Reservar</a>
                        </div>
                    </div>
                            
                        
                    </div>`);

                let footer = document.getElementById("footer");
                footer.style.bottom = "0";
                footer.style.left = "0";
                footer.style.right = "0";

                </script>';
            } else if ($total == 1) {
                $param = array();
                $param['Cliente'] = $id_cliente;

                $consulta = "select * from reservas where id_cliente = :Cliente";

                $db->ConsultaDatos($consulta, $param);

                echo '<script>

                main = $("#main");

                main.append(`

                    <h1 class="d-flex justify-content-center centered-text mt-5 mb-5">Carrito</h1>
                    <div class="container py-5">
                            
                            <div id="reservas" class="card-columns2">
                                
                            </div>
                        
                    </div>`);

                </script>';

                foreach ($db->filas as $fila) {

                    $param = array();
                    $param['Habitacion'] = $fila['id_habitacion'];

                    $consulta = "select imagen as 'imagen', tipo_habitacion as 'tipo' from habitaciones where id_habitacion = :Habitacion";

                    $db->ConsultaDatos($consulta, $param);

                    $imagen = $db->filas[0]['imagen'];
                    $tipo = $db->filas[0]['tipo'];

                    echo '<script>

                    reservas = $("#reservas");

                    reservas.append(`

                    <div class="card mb-5">
                            <img src="data:image/jpg;base64,' . base64_encode($imagen) . '" class="card-img-top" alt="Imagen Habitacion">
                            <div class="card-body">
                                <h5 class="card-title">' . $tipo . '</h5>
                                <br>
                                <p class="card-text">Fecha de Inicio: ' . $fila['fecha_inicio'] . '</p>
                                <p class="card-text">Fecha de Fin: ' . $fila['fecha_fin'] . '</p>
                                <button id="reservar" class="btn btn-primary">Cancelar Reserva</button>
                            </div>
                        </div>

                        `);

                    </script>';
                }
            } else {
                $param = array();
                $param['Cliente'] = $id_cliente;

                $consulta = "select * from reservas where id_cliente = :Cliente";

                $db->ConsultaDatos($consulta, $param);

                echo '<script>

                main = $("#main");

                main.append(`

                    <h1 class="d-flex justify-content-center centered-text mt-5 mb-5">Carrito</h1>
                    <div class="container py-5">
                            
                            <div id="reservas" class="card-columns3">
                                
                            </div>
                        
                    </div>`);

                </script>';

                foreach ($db->filas as $fila) {

                    $param = array();
                    $param['Habitacion'] = $fila['id_habitacion'];

                    $consulta = "select imagen as 'imagen', tipo_habitacion as 'tipo' from habitaciones where id_habitacion = :Habitacion";

                    $db->ConsultaDatos($consulta, $param);

                    $imagen = $db->filas[0]['imagen'];
                    $tipo = $db->filas[0]['tipo'];

                    echo '<script>

                    reservas = $("#reservas");

                    reservas.append(`

                    <div class="card mb-5">
                            <img src="data:image/jpg;base64,' . base64_encode($imagen) . '" class="card-img-top" alt="Imagen Habitacion">
                            <div class="card-body">
                                <h5 class="card-title">' . $tipo . '</h5>
                                <br>
                                <p class="card-text">Fecha de Inicio: ' . $fila['fecha_inicio'] . '</p>
                                <p class="card-text">Fecha de Fin: ' . $fila['fecha_fin'] . '</p>
                                <button id="reservar" class="btn btn-primary">Cancelar Reserva</button>
                            </div>
                        </div>

                        `);

                    </script>';
                }
            }
        }

        public function reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion)
        {

            //Necesito el id del usuario, con ese id del usuario saco el id del cliente, y con el id del cliente saco las habitaciones que tiene reservadas

            $param = array();
            $param['Usuario'] = $usuario;

            $consulta = "select id_usuario as id_usuario from usuarios where usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_usuario = $db->filas[0]['id_usuario'];

            // echo $id_usuario;

            $param = array();
            $param['Usuario'] = $id_usuario;

            $consulta = "select id_cliente as id_cliente from clientes where id_usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_cliente = $db->filas[0]['id_cliente'];

            // echo $id_cliente;

            $param = array();
            $param['Habitacion'] = $id_habitacion;
            $param['Inicio'] = $fechaInicio;
            $param['Fin'] = $fechaFin;
            $param['Cliente'] = $id_cliente;

            $consulta = "insert into reservas values (NULL, :Habitacion, :Inicio, :Fin, :Cliente)";

            $db->ConsultaSimple($consulta, $param);
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>