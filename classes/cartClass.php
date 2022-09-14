<?php
require_once __DIR__.'/../inc/connection.php';

class Cart extends Connection{

    public function addToCart($user_id, $product_id, $product_name, $price, $quantity){
        $sql = 'INSERT INTO cart (user_id, product_id, product_name, price, quantity) VALUES (?,?, ?, ?, ?)';
        


    }
}