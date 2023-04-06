<?php

require_once "LibreriaPDO.php";

$db = new DB("hotel");

class ProductModel
{
    public function datosBBDD($db)
    {
        $param = array();

        $consulta = "select * from habitaciones";

        $db->ConsultaDatos($consulta, $param);

        return $db;

    }
}
