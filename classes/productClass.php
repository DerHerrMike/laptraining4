<?php
require_once __DIR__ . '/../inc/connection.php';

class Product extends Connection
{
    /**
     * @return array|false
     */
    public function loadAllProducts(): bool|array
    {
        $sql = "SELECT * FROM laptraining4.product WHERE status = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function loadOneProduct($productId): mixed
    {
        $sql = "SELECT * FROM laptraining4.product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch();
    }

    /**
     * @return bool|array
     */
    public function getProductsAdmin(): bool|array
    {
        $sql = "SELECT * FROM laptraining4.product";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOneProductById($id): mixed
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * @param $id
     */
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        echo 'Product deleted successfully.';
        header("Refresh:1; url=admin_products.php");
    }

    /**
     * @param $updateData
     * @param $id
     */
    public function updateProduct($updateData, $id)
    {
        $sql = "UPDATE product SET name = ?, description =?, image = ?, price = ?, status = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$updateData['name'], $updateData['description'], $updateData['image'], $updateData['price'], $updateData['status'], $id]);
        echo 'Product updated successfully.';
        header("Refresh:1; url=admin_products.php");
    }

    /**
     * @param $productData
     */
    public function addProduct($productData)
    {
        $sql = "INSERT INTO product (name, description, image, price, status) VALUES (?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productData['name'], $productData['description'], $productData['image'], $productData['price'], $productData['status']]);
        echo 'Product added successfully.';
        header("Refresh:1; url=admin_products.php");
    }
}