<?php

class ProductModel {
    private $products = [
        ['name' => 'Product A', 'price' => 10],
        ['name' => 'Product B', 'price' => 20],
        ['name' => 'Product C', 'price' => 30],
        ['name' => 'Product D', 'price' => 40],
        ['name' => 'Product E', 'price' => 50]
    ];
    
    public function getAllProducts() {
        return $this->products;
    }
}

?>
