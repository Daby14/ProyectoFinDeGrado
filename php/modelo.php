<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel GD</title>

    <!-- Carga los archivos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="../images/favicon.jpg">

</head>

<body>

    <?php

    require_once "LibreriaPDO.php";

    $db = new DB("epiz_34160839_hotelgd");

    class Model
    {

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

            function obtenerNombreMes($mes_numero)
            {
                $meses = array(
                    "01" => "enero",
                    "02" => "febrero",
                    "03" => "marzo",
                    "04" => "abril",
                    "05" => "mayo",
                    "06" => "junio",
                    "07" => "julio",
                    "08" => "agosto",
                    "09" => "septiembre",
                    "10" => "octubre",
                    "11" => "noviembre",
                    "12" => "diciembre"
                );

                return ucfirst($meses[$mes_numero]);
            }

            if ($total == 0) {
                echo '<script>

                main = $("#main");

                main.append(`
                    <div class="container py-5">

                    <div class="card noReserva" style="width: 18rem;">
                        <img src="../images/reserva.png" class="card-img-top" alt="reserva">
                        <div class="card-body">
                            <h5 class="card-title">Carrito Vacío</h5>
                            <p class="card-text">Te animamos a que reserves nuestras lujosas habitaciones.</p>
                            <a id="reservarCarrito" href="https://hotelgdfree.epizy.com/?habitacionesHotel" class="btn btn-primary">Reservar</a>
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

                    //Obtenemos la fecha de inicio y la de fin
                    $componentes_inicio = explode("-", $fila['fecha_inicio']);
                    $componentes_fin = explode("-", $fila['fecha_fin']);

                    $dia_inicio = $componentes_inicio[2];
                    $mes_inicio = $componentes_inicio[1];
                    $anio_inicio = $componentes_inicio[0];

                    $dia_fin = $componentes_fin[2];
                    $mes_fin = $componentes_fin[1];
                    $anio_fin = $componentes_fin[0];

                    $mes_numero_inicio = $mes_inicio;
                    $mes_numero_fin = $mes_fin;
                    $nombre_mes_inicio = obtenerNombreMes($mes_numero_inicio);
                    $nombre_mes_fin = obtenerNombreMes($mes_numero_fin);

                    $fecha_inicio = $dia_inicio . " de " . $nombre_mes_inicio . " de " . $anio_inicio;
                    $fecha_fin = $dia_fin . " de " . $nombre_mes_fin . " de " . $anio_fin;

                    echo '<script>

                    reservas = $("#reservas");

                    reservas.append(`

                    <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../images/' . $imagen . '" class="img-fluid rounded-start" alt="asfd">
                            </div>
                            <div class="col-md-7" style="display:block; margin:auto;">
                                <div class="card-body">
                                    <h5 class="card-title text-light">' . $tipo . '</h5>
                                    <p class="card-text text-light">Fecha de Inicio: ' . $fecha_inicio . '</p>
                                    <p class="card-text text-light">Fecha de Fin: ' . $fecha_fin . '</p>
                                    <a id="cancelar" href="#" class="btn btn-light" data-type=" ' . $fila['id_reserva'] . ' ">Cancelar Reserva</a>
                                </div>
                            </div>
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

                    //Obtenemos la fecha de inicio y la de fin
                    $componentes_inicio = explode("-", $fila['fecha_inicio']);
                    $componentes_fin = explode("-", $fila['fecha_fin']);

                    $dia_inicio = $componentes_inicio[2];
                    $mes_inicio = $componentes_inicio[1];
                    $anio_inicio = $componentes_inicio[0];

                    $dia_fin = $componentes_fin[2];
                    $mes_fin = $componentes_fin[1];
                    $anio_fin = $componentes_fin[0];

                    $mes_numero_inicio = $mes_inicio;
                    $mes_numero_fin = $mes_fin;
                    $nombre_mes_inicio = obtenerNombreMes($mes_numero_inicio);
                    $nombre_mes_fin = obtenerNombreMes($mes_numero_fin);

                    $fecha_inicio = $dia_inicio . " de " . $nombre_mes_inicio . " de " . $anio_inicio;
                    $fecha_fin = $dia_fin . " de " . $nombre_mes_fin . " de " . $anio_fin;

                    echo '<script>

                    reservas = $("#reservas");

                    reservas.append(`

                    <div class="card mb-5 w-100 noReserva" style="background:rgb(33, 37, 41);">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../images/' . $imagen . '" class="img-fluid rounded-start" alt="asfd">
                            </div>
                            <div class="col-md-7" style="display:block; margin:auto;">
                                <div class="card-body">
                                    <h5 class="card-title text-light">' . $tipo . '</h5>
                                    <p class="card-text text-light">Fecha de Inicio: ' . $fecha_inicio . '</p>
                                    <p class="card-text text-light">Fecha de Fin: ' . $fecha_fin . '</p>
                                    <a id="cancelar" href="#" class="btn btn-light" data-type=" ' . $fila['id_reserva'] . ' ">Cancelar Reserva</a>
                                </div>
                            </div>
                        </div>
                    </div>

                        `);

                    </script>';
                }
            }
        }

        public function reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion)
        {

            $param = array();
            $param['Usuario'] = $usuario;

            $consulta = "select id_usuario as id_usuario from usuarios where usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_usuario = $db->filas[0]['id_usuario'];

            $param = array();
            $param['Usuario'] = $id_usuario;

            $consulta = "select id_cliente as id_cliente from clientes where id_usuario = :Usuario";

            $db->ConsultaDatos($consulta, $param);

            $id_cliente = $db->filas[0]['id_cliente'];

            $param = array();
            $param['Habitacion'] = $id_habitacion;
            $param['Inicio'] = $fechaInicio;
            $param['Fin'] = $fechaFin;
            $param['Cliente'] = $id_cliente;

            $consulta = "insert into reservas values (NULL, :Habitacion, :Inicio, :Fin, :Cliente)";

            $db->ConsultaSimple($consulta, $param);

            $param = array();
            $param['Estado'] = "Ocupado";
            $param['Habitacion'] = $id_habitacion;

            $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Habitacion";

            $db->ConsultaSimple($consulta, $param);
        }

        public function actualizarReservas($db)
        {

            $param = array();

            $consulta = "select * from reservas";

            $db->ConsultaDatos($consulta, $param);

            foreach ($db->filas as $fila) {

                date_default_timezone_set('Europe/Madrid');

                $fecha = date('Y-m-d');

                $fecha_fin = $fila['fecha_fin'];

                //Si la fecha de hoy es mayor que la de fin de la reserva, borramos la reserva y volvemos a poner la habitación como disponible
                if (strtotime($fecha) > strtotime($fecha_fin)) {

                    $param = array();
                    $param['Habitacion'] = $fila['id_habitacion'];
                    $param['Estado'] = "Disponible";

                    $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Habitacion";

                    $db->ConsultaSimple($consulta, $param);

                    $param = array();
                    $param['Reserva'] = $fila['id_reserva'];

                    $consulta = "delete from reservas where id_reserva=:Reserva";

                    $db->ConsultaSimple($consulta, $param);
                }
            }
        }

        public function cancelarReserva($db, $id)
        {

            $param = array();
            $param['Reserva'] = $id;

            $consulta = "select id_habitacion as id_habitacion from reservas where id_reserva=:Reserva";

            $db->ConsultaDatos($consulta, $param);

            $id_habitacion = $db->filas[0]['id_habitacion'];

            $param = array();
            $param['Habitacion'] = $id_habitacion;
            $param['Estado'] = "Disponible";

            $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Habitacion";

            $db->ConsultaSimple($consulta, $param);

            $param = array();
            $param['Reserva'] = $id;

            $consulta = "delete from reservas where id_reserva=:Reserva";

            $db->ConsultaSimple($consulta, $param);
        }

        public function reservasAdmin($db)
        {

            $param = array();

            $consulta = "select count(*) as 'total' from reservas";

            $db->ConsultaDatos($consulta, $param);

            $total = $db->filas[0]['total'];

            if ($total == 0) {
                echo '<script>
                
                main = $("#main");

                main.append(`

                    <div class="container py-5">

                    <div class="card noReserva" style="width: 18rem;">
                        <img src="../images/noExistenReservas.jpg" class="card-img-top" alt="noExistenReservas">
                        <div class="card-body">
                            <h5 class="card-title">No existen reservas</h5>
                            <p class="card-text">Cuando existan reservas aparecerán aquí</p>
                        </div>
                    </div>
                            
                        
                    </div>`);

                let footer = document.getElementById("footer");
                footer.style.bottom = "0";
                footer.style.left = "0";
                footer.style.right = "0";
                
                </script>';
            } else {
                $param = array();

                $consulta = "select * from reservas";

                $db->ConsultaDatos($consulta, $param);

                echo '<script>

                $("#footer").css({
                    "margin-top": "100px"
                });

                $("#main").append(`

                <h4 class="noReserva mt-5">Reservas</h4>

                <div class="container py-5">
                    <div id="reservasDisponiblesAdmin" class="card-columns2">
                
                    </div>
                </div>

                
                
                `);

                
                
            </script>';

                foreach ($db->filas as $fila) {

                    //Obtenemos el nombre de la habitacion
                    $param = array();
                    $param['Tipo'] = $fila['id_habitacion'];

                    $consulta = "select tipo_habitacion as 'tipo' from habitaciones where id_habitacion = :Tipo";

                    $db->ConsultaDatos($consulta, $param);

                    $tipo = $db->filas[0]['tipo'];
                    $palabras = explode(' ', $tipo);
                    $resultado = trim($palabras[1]);

                    //Obtenemos la imagen de la habitacion
                    $param = array();
                    $param['Tipo'] = $fila['id_habitacion'];

                    $consulta = "select imagen as 'imagen' from habitaciones where id_habitacion = :Tipo";

                    $db->ConsultaDatos($consulta, $param);

                    $imagen = $db->filas[0]['imagen'];

                    //Obtenemos el nombre del usuario que ha reservado
                    $param = array();
                    $param['Id'] = $fila['id_cliente'];

                    $consulta = "select id_usuario as 'id_usuario' from clientes where id_cliente = :Id";

                    $db->ConsultaDatos($consulta, $param);

                    $id_usuario = $db->filas[0]['id_usuario'];

                    $param = array();
                    $param['Id'] = $id_usuario;

                    $consulta = "select usuario as 'usuario' from usuarios where id_usuario = :Id";

                    $db->ConsultaDatos($consulta, $param);

                    $usuario = $db->filas[0]['usuario'];

                    echo '<script>

                    $("#reservasDisponiblesAdmin").append(`

                    <div class="card mb-5 w-100 noReserva text-light" style="background:rgb(33, 37, 41);">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../images/' . $imagen . '" class="img-fluid rounded-start" alt="reservaImagen">
                            </div>
                            <div class="col-md-7" style="display:block; margin:auto;">
                                <div class="card-body">
                                    <h5 class="card-title">Reserva de ' . $usuario . '</h5>
                                    <br>
                                    <p class="card-text">' . $tipo . '</p>
                                    <p class="card-text">' . $fila['fecha_inicio'] . ' --> ' . $fila['fecha_fin'] . '</p>
                                    <br>
                                    <p class="card-text">
                                        
                                        <a href="https://hotelgdfree.epizy.com/?borrarReservaAdmin=' . $fila['id_reserva'] . '" class="btn btn-light">Borrar</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                    `);

                    
                </script>';
                }
            }
        }

        public function contactoDatos($db)
        {

            $param = array();

            $consulta = "select count(*) as 'total' from contacto";

            $db->ConsultaDatos($consulta, $param);

            $total = $db->filas[0]['total'];

            if ($total == 0) {
                echo '<script>
                
                main = $("#main");

                main.append(`
                    <div class="container py-5">

                    <div class="card noReserva" style="width: 18rem;">
                        <img src="../images/noMensajes.png" class="card-img-top" alt="noReservas">
                        <div class="card-body">
                            <h5 class="card-title">No existen mensajes</h5>
                            <p class="card-text">Cuando existan mensajes aparecerán aquí</p>
                        </div>
                    </div>
                            
                        
                    </div>`);

                let footer = document.getElementById("footer");
                footer.style.bottom = "0";
                footer.style.left = "0";
                footer.style.right = "0";
                
                </script>';
            } else {
                $param = array();

                $consulta = "select * from contacto";

                $db->ConsultaDatos($consulta, $param);

                echo '<script>

                $("#footer").css({
                    "margin-top": "100px"
                });

                $("#main").append(`

                <h4 class="noReserva mt-5">Mensajes</h4>
            
                `);
                
                </script>';

                foreach ($db->filas as $fila) {

                    echo '<script>

                    $("#main").append(`

                    <div class="card mb-3 noReserva mt-5 text-light" style="background:rgb(33, 37, 41); max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-12">
                            <div class="card-body">
                                <h5 class="card-title">Mensaje de ' . $fila['nombre'] . '</h5>
                                <p class="card-text">Correo: ' . $fila['correo'] . '</p>
                                <p class="card-text">Telefono: ' . $fila['telefono'] . '</p>
                                <p class="card-text">' . $fila['mensaje'] . '</p>

                                <p class="card-text"><a href="https://hotelgdfree.epizy.com/?borrarMensaje=' . $fila['id_contacto'] . '" class="btn btn-light">Borrar</a></p>
                            </div>
                            </div>
                        </div>
                    </div>
                
                    `);
                    
                    </script>';
                }
            }
        }

        public function clientesAdmin($db)
        {

            $param = array();

            $consulta = "select * from clientes";

            $db->ConsultaDatos($consulta, $param);

            echo '<script>

                $("#main").append(`

                <h4 class="noReserva mt-5">Clientes</h4>
            
                `);
                
            </script>';

            foreach ($db->filas as $fila) {

                echo '<script>

                $("#main").append(`

                <div class="card mb-5 noReserva mt-5 text-light" style="background:rgb(33, 37, 41); max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">Cliente ' . $fila['nombre'] . '</h5>
                            <p class="card-text">Correo: ' . $fila['email'] . '</p>

                            <p class="card-text"><a href="https://hotelgdfree.epizy.com/?borrarCliente=' . $fila['id_cliente'] . '" class="btn btn-light">Borrar</a></p>
                        </div>
                        </div>
                    </div>
                </div>
            
                `);
                
                </script>';
            }
        }

        public function usuariosAdmin($db)
        {

            $param = array();

            $consulta = "select * from usuarios";

            $db->ConsultaDatos($consulta, $param);

            echo '<script>

                $("#main").append(`

                <h4 class="noReserva mt-5">Usuarios</h4>
            
                `);
                
            </script>';

            foreach ($db->filas as $fila) {

                echo '<script>

                $("#main").append(`

                <div class="card mb-5 noReserva mt-5 text-light" style="background:rgb(33, 37, 41); max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">Usuario ' . $fila['usuario'] . '</h5>
                            <br>
                            <br>
                            <p class="card-text"><a href="https://hotelgdfree.epizy.com/?borrarUsuario=' . $fila['id_usuario'] . '" class="btn btn-light">Borrar</a></p>
                        </div>
                        </div>
                    </div>
                </div>
            
                `);
                
                </script>';
            }
        }

    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>