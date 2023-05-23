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

if ($select === "id") {
    $type = $_POST['type'];

    $datosHabitacion =  habitacionEspecifica($type, $db);

    $response = array('exists' => $datosHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
}else if ($select === "habitaciones") {
    $type = $_POST['type'];

    $datosHotel =  habitacionesHotel($type, $db);

    $response = array('exists' => $datosHotel);

    header('Content-Type: application/json');
    echo json_encode($response);
}else if ($select === "idEspecifico") {
    $type = $_POST['type'];

    $datosHabitacionReserva =  habitacionEspecificaReserva($type, $db);

    $response = array('exists' => $datosHabitacionReserva);

    header('Content-Type: application/json');
    echo json_encode($response);
}
