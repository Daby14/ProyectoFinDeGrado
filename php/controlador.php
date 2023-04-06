<?php

require_once 'modelo.php';
$productsModel = new ProductModel();

$datos = $productsModel->datosBBDD($db);

require_once 'vista.php';

?>