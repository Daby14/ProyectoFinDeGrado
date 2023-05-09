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
            $param['Nombre'] = $nombre;
            $param['Apellido'] = $apellido;
            $param['Email'] = $email;
            $param['Telefono'] = $telefono;

            $consulta = "insert into clientes values (NULL, :Nombre, :Apellido, :Email, :Telefono)";

            $db->ConsultaSimple($consulta, $param);

            $param = array();
            $param['Usuario'] = $usuario;
            $param['Password'] = $password;

            $consulta = "insert into usuarios values (NULL, :Usuario, :Password)";

            $db->ConsultaSimple($consulta, $param);
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>