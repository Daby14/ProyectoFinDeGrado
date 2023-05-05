<?php

// if (isset($_POST['nombreCompleto'])) {

//     $nombreCompleto = $_POST['nombreCompleto'];

//     if (empty($nombreCompleto)) {

//         echo json_encode("Incorrecto");
//     } else {

//         echo json_encode("Correcto <br> Nombre Completo: " . $nombreCompleto);
//     }
// }

// Recibimos el JSON enviado por JavaScript mediante el método POST
// $json = file_get_contents('php://input');
// echo "Datos recibidos: " . $json;
// echo "Datos recibidos:\n";
// var_dump($json);

// try {
//     $data = json_decode($json, true);
//     var_dump($data);

//     echo "Nombre: " . $data['nombre'] . "\n";
//     echo "Edad: " . $data['edad'] . "\n";
//     echo "Ciudad: " . $data['ciudad'] . "\n";
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }
$productos = json_decode($_POST["json"]);
var_dump($productos);

