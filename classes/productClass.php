<?php
require_once __DIR__ . '/../inc/connection.php';

class Product extends Connection
{
    public function loadAllProducts()
    {

        $sql = "SELECT * FROM laptraining4.product";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function loadOneProduct($productId) {
        $sql = "SELECT * FROM laptraining4.product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productId]);
        $result = $stmt->fetch();
        return $result;

    }

}