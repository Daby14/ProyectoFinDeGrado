<?php

// require_once("../Model/user.php");
// require_once("../Model/DaoUser.php");

require_once "LibreriaPDO.php";

$db = new DB("epiz_34160839_hotelgd");

$select = $_GET['tipo'];

function habitacionEspecifica($type, $db)
{
    $param = array();
    $param['Tipo'] = $type;

    $consulta = "select * from habitaciones where id_habitacion = :Tipo";

    $db->ConsultaDatos($consulta, $param);

    $arrayDatos = array();

    foreach ($db->filas as $fila) {
        $arrayDatos[] = base64_encode($fila['imagen']);
        $arrayDatos[] = $fila['tipo_habitacion'];
        $arrayDatos[] = $fila['precio'];
        $arrayDatos[] = $fila['descripcion'];
        $arrayDatos[] = $fila['estado'];
        $arrayDatos[] = $fila['id_habitacion'];
    }

    //itero $db

    //cada elemento de $db lo añado

    return $arrayDatos;
}

function habitacionesHotel($type, $db)
{

    $param = array();
    $param['Estado'] = $type;

    $consulta = "select * from habitaciones where estado = :Estado";

    $db->ConsultaDatos($consulta, $param);

    $arrayDatos = array();

    foreach ($db->filas as $fila) {
        $arrayDatos[] = base64_encode($fila['imagen']);
        $arrayDatos[] = $fila['tipo_habitacion'];
        $arrayDatos[] = $fila['precio'];
        $arrayDatos[] = $fila['descripcion'];
        $arrayDatos[] = $fila['estado'];
        $arrayDatos[] = $fila['id_habitacion'];
    }

    return $arrayDatos;
}

function habitacionEspecificaReserva($type, $db)
{

    return $type;
}

function datosSesion($usuario, $password, $db)
{

    $param = array();
    $param['Usuario'] = $usuario;
    $param['Password'] = $password;

    $consulta = "select count(*) as total from usuarios where usuario = :Usuario and password = :Password";

    $db->ConsultaDatos($consulta, $param);

    $total = $db->filas[0]['total'];

    $cadena = '';

    if ($total == 0) {
        $cadena = 'loginIncorrecto';
    } else {
        $cadena = $usuario;
    }

    return $cadena;
}

function datosRegistro($nombre, $apellido, $usuario, $password, $email, $telefono, $db)
{

    $param = array();
    $param['Usuario'] = $usuario;
    $consulta = "select count(*) as total from usuarios where usuario = :Usuario";

    $db->ConsultaDatos($consulta, $param);

    $total = $db->filas[0]['total'];

    $cadena = '';

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

        $cadena = 'registrado';
    } else {
        $cadena = 'no registrado';
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

    return $cadena;
}

function datosReserva($fechaInicio, $fechaFin, $id, $usuario, $db)
{

    date_default_timezone_set("Europe/Madrid");

    $fecha = date("Y-m-d");

    $cadena = "";

    if (($fechaInicio < $fecha) || ($fechaFin <= $fechaInicio)) {
        $cadena = "fallo";
    } else {
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
        $param['Habitacion'] = $id;
        $param['Inicio'] = $fechaInicio;
        $param['Fin'] = $fechaFin;
        $param['Cliente'] = $id_cliente;

        $consulta = "insert into reservas values (NULL, :Habitacion, :Inicio, :Fin, :Cliente)";

        $db->ConsultaSimple($consulta, $param);

        $param = array();
        $param['Estado'] = "Ocupado";
        $param['Habitacion'] = $id;

        $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Habitacion";

        $db->ConsultaSimple($consulta, $param);

        $cadena = "no fallo";
    }

    return $cadena;

}

function cancelarReserva($type, $db)
{

    $param = array();
    $param['Reserva'] = $type;

    $consulta = "select id_habitacion as id_habitacion from reservas where id_reserva=:Reserva";

    $db->ConsultaDatos($consulta, $param);

    $id_habitacion = $db->filas[0]['id_habitacion'];

    $param = array();
    $param['Habitacion'] = $id_habitacion;
    $param['Estado'] = "Disponible";

    $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Habitacion";

    $db->ConsultaSimple($consulta, $param);

    $param = array();
    $param['Reserva'] = $type;

    $consulta = "delete from reservas where id_reserva=:Reserva";

    $db->ConsultaSimple($consulta, $param);

    return "conseguido";
}

if ($select === "id") {
    $type = $_POST['type'];

    $datosHabitacion =  habitacionEspecifica($type, $db);

    $response = array('exists' => $datosHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "habitaciones") {
    $type = $_POST['type'];

    $datosHotel =  habitacionesHotel($type, $db);

    $response = array('exists' => $datosHotel);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "idEspecifico") {
    $type = $_POST['type'];

    $datosHabitacionReserva =  habitacionEspecificaReserva($type, $db);

    $response = array('exists' => $datosHabitacionReserva);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "sesion") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $datosSesion =  datosSesion($usuario, $password, $db);

    $response = array('exists' => $datosSesion);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "registro") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $datosRegistro =  datosRegistro($nombre, $apellido, $usuario, $password, $email, $telefono, $db);

    $response = array('exists' => $datosRegistro);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "reserva") {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];

    $datosReserva =  datosReserva($fechaInicio, $fechaFin, $id, $usuario, $db);

    $response = array('exists' => $datosReserva);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "cancelarReserva") {
    $type = $_POST['type'];

    $cancelarReserva =  cancelarReserva($type, $db);

    $response = array('exists' => $cancelarReserva);

    header('Content-Type: application/json');
    echo json_encode($response);
}
