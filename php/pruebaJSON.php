<?php

// require_once("../Model/user.php");
// require_once("../Model/DaoUser.php");

require_once "LibreriaPDO.php";

$db = new DB("epiz_34160839_hotelgd");

$select = $_GET['tipo'];

function verifyEmail($type, $db)
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

if ($select === "id") {
    $type = $_POST['type'];

    $emailExists =  verifyEmail($type, $db);

    $response = array('exists' => $emailExists);

    //$response = array('exists' => true);
    header('Content-Type: application/json');
    echo json_encode($response);
}
