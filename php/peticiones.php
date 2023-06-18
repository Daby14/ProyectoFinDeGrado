<?php

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
        $arrayDatos[] = $fila['imagen'];
        $arrayDatos[] = $fila['tipo_habitacion'];
        $arrayDatos[] = $fila['precio'];
        $arrayDatos[] = $fila['descripcion'];
        $arrayDatos[] = $fila['estado'];
        $arrayDatos[] = $fila['id_habitacion'];
    }

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
        $arrayDatos[] = $fila['imagen'];
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
    $password = sha1($password);
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

function datosRegistro($nombre, $apellido, $usuario, $password, $email, $db)
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
        $param['Usuario'] = '52';

        $consulta = "insert into clientes values (NULL, :Nombre, :Apellido, :Email, :Usuario)";

        $db->ConsultaSimple($consulta, $param);

        $param = array();
        $param['Usuario'] = $usuario;

        $password = sha1($password);

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

function agregaHabitacion($idHabitacion, $tipoHabitacion, $precio, $estado, $imagen, $descripcion, $db)
{

    $param = array();
    $param['Id'] = $idHabitacion;
    $param['Tipo'] = $tipoHabitacion;
    $param['Precio'] = $precio;
    $param['Estado'] = $estado;
    $param['Imagen'] = $imagen;
    $param['Descripcion'] = $descripcion;

    $consulta = "insert into habitaciones values (:Id, :Tipo, :Precio, :Estado, :Imagen, :Descripcion)";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function borrarHabitacion($id, $db)
{

    $param = array();
    $param['Id'] = $id;

    $consulta = "delete from habitaciones where id_habitacion=:Id";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function cancelarReservaAdmin($id, $db)
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

    $cadena = "conseguido";

    return $cadena;
}

function actualizaHabitacion($idHabitacion, $tipoHabitacion, $precio, $estado, $imagen, $descripcion, $db)
{

    $param = array();
    $param['Id'] = $idHabitacion;
    $param['Tipo'] = $tipoHabitacion;
    $param['Precio'] = $precio;
    $param['Estado'] = $estado;
    $param['Imagen'] = $imagen;
    $param['Descripcion'] = $descripcion;

    $consulta = "update habitaciones set tipo_habitacion=:Tipo, precio=:Precio, estado=:Estado, imagen=:Imagen, descripcion=:Descripcion where id_habitacion=:Id";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function contacto($nombre, $correo, $telefono, $mensaje, $db)
{

    $param = array();
    $param['Nombre'] = $nombre;
    $param['Correo'] = $correo;
    $param['Telefono'] = $telefono;
    $param['Mensaje'] = $mensaje;

    $consulta = "insert into contacto values (NULL, :Nombre, :Correo, :Telefono, :Mensaje)";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function borrarMensaje($id, $db)
{

    $param = array();
    $param['Id'] = $id;

    $consulta = "delete from contacto where id_contacto=:Id";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function borrarCliente($id, $db)
{

    $param = array();
    $param['Id'] = $id;

    $consulta = "select count(*) as 'total' from reservas where id_cliente=:Id";

    $db->ConsultaDatos($consulta, $param);

    $total = $db->filas[0]['total'];

    if ($total != 0) {
        $param = array();
        $param['Id'] = $id;

        $consulta = "select * from reservas where id_cliente=:Id";

        $db->ConsultaDatos($consulta, $param);

        foreach ($db->filas as $fila) {

            $id_reserva = $fila['id_reserva'];
            $id_habitacion = $fila['id_habitacion'];

            $param = array();
            $param['Id'] = $id_reserva;

            $consulta = "delete from reservas where id_reserva=:Id";

            $db->ConsultaSimple($consulta, $param);

            $param = array();
            $param['Estado'] = "Disponible";
            $param['Id'] = $id_habitacion;

            $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Id";

            $db->ConsultaSimple($consulta, $param);
        }
    }

    $param = array();
    $param['Id'] = $id;

    $consulta = "select id_usuario as 'id_usuario' from clientes where id_cliente=:Id";

    $db->ConsultaDatos($consulta, $param);

    $id_usuario = $db->filas[0]['id_usuario'];

    $param = array();
    $param['Id'] = $id;

    $consulta = "delete from clientes where id_cliente=:Id";

    $db->ConsultaSimple($consulta, $param);

    $param = array();
    $param['Id'] = $id_usuario;

    $consulta = "delete from usuarios where id_usuario=:Id";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function borrarUsuario($id, $db)
{

    $param = array();
    $param['Id'] = $id;

    $consulta = "select id_cliente as 'id_cliente' from clientes where id_usuario=:Id";

    $db->ConsultaDatos($consulta, $param);

    $id_cliente = $db->filas[0]['id_cliente'];

    $param = array();
    $param['Id'] = $id_cliente;

    $consulta = "select count(*) as 'total' from reservas where id_cliente=:Id";

    $db->ConsultaDatos($consulta, $param);

    $total = $db->filas[0]['total'];

    if ($total != 0) {
        $param = array();
        $param['Id'] = $id_cliente;

        $consulta = "select * from reservas where id_cliente=:Id";

        $db->ConsultaDatos($consulta, $param);

        foreach ($db->filas as $fila) {

            $id_reserva = $fila['id_reserva'];
            $id_habitacion = $fila['id_habitacion'];

            $param = array();
            $param['Id'] = $id_reserva;

            $consulta = "delete from reservas where id_reserva=:Id";

            $db->ConsultaSimple($consulta, $param);

            $param = array();
            $param['Estado'] = "Disponible";
            $param['Id'] = $id_habitacion;

            $consulta = "update habitaciones set estado=:Estado where id_habitacion=:Id";

            $db->ConsultaSimple($consulta, $param);
        }
    }

    $param = array();
    $param['Id'] = $id_cliente;

    $consulta = "delete from clientes where id_cliente=:Id";

    $db->ConsultaSimple($consulta, $param);

    $param = array();
    $param['Id'] = $id;

    $consulta = "delete from usuarios where id_usuario=:Id";

    $db->ConsultaSimple($consulta, $param);

    $cadena = "conseguido";

    return $cadena;
}

function actualizarHabitacion($id, $db)
{

    $param = array();
    $param['Id'] = $id;

    $consulta = "select * from habitaciones where id_habitacion = :Id";

    $db->ConsultaDatos($consulta, $param);

    $arrayDatos = array();

    foreach ($db->filas as $fila) {
        $arrayDatos[] = $fila['tipo_habitacion'];
        $arrayDatos[] = $fila['precio'];
        $arrayDatos[] = $fila['descripcion'];
        $arrayDatos[] = $fila['estado'];
    }

    return $arrayDatos;

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

    $datosRegistro =  datosRegistro($nombre, $apellido, $usuario, $password, $email, $db);

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
} else if ($select === "agregaHabitacion") {
    $idHabitacion = $_POST['idHabitacion'];
    $tipoHabitacion = $_POST['tipoHabitacion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $agregaHabitacion =  agregaHabitacion($idHabitacion, $tipoHabitacion, $precio, $estado, $imagen, $descripcion, $db);

    $response = array('exists' => $agregaHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "borrarHabitacion") {
    $id = $_POST['id'];

    $borrarHabitacion =  borrarHabitacion($id, $db);

    $response = array('exists' => $borrarHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "cancelarReservaAdmin") {
    $id = $_POST['id'];

    $cancelarReservaAdmin =  cancelarReservaAdmin($id, $db);

    $response = array('exists' => $cancelarReservaAdmin);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "actualizaHabitacion") {
    $idHabitacion = $_POST['idHabitacion'];
    $tipoHabitacion = $_POST['tipoHabitacion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $actualizaHabitacion =  actualizaHabitacion($idHabitacion, $tipoHabitacion, $precio, $estado, $imagen, $descripcion, $db);

    $response = array('exists' => $actualizaHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "contacto") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    $contacto =  contacto($nombre, $correo, $telefono, $mensaje, $db);

    $response = array('exists' => $contacto);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "borrarMensaje") {
    $id = $_POST['id'];

    $borrarMensaje =  borrarMensaje($id, $db);

    $response = array('exists' => $borrarMensaje);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "borrarCliente") {
    $id = $_POST['id'];

    $borrarCliente =  borrarCliente($id, $db);

    $response = array('exists' => $borrarCliente);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "borrarUsuario") {
    $id = $_POST['id'];

    $borrarUsuario =  borrarUsuario($id, $db);

    $response = array('exists' => $borrarUsuario);

    header('Content-Type: application/json');
    echo json_encode($response);
} else if ($select === "actualizarHabitacion") {
    $id = $_POST['id'];

    $actualizarHabitacion =  actualizarHabitacion($id, $db);

    $response = array('exists' => $actualizarHabitacion);

    header('Content-Type: application/json');
    echo json_encode($response);
}