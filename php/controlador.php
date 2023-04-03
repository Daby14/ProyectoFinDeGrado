<?php

require_once 'modelo.php';
$productsModel = new ProductModel();
$products = $productsModel->getAllProducts();
require_once 'vista.php';

?>