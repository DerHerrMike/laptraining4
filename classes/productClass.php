<?php
require_once __DIR__ . '/../inc/connection.php';

class Product extends Connection
{
    /**
     * @return array|false
     */
    public function loadAllProducts()
    {

        $sql = "SELECT * FROM laptraining4.product WHERE status = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function loadOneProduct($productId) {

        $sql = "SELECT * FROM laptraining4.product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productId]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getProductsAdmin(): bool|array
    {
        $sql = "SELECT * FROM laptraining4.product ORDER BY id ASC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}