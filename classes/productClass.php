<?php
require_once __DIR__ . '/../inc/connection.php';

class Product
{

    private function getTableName(): string
    {
        return "product";
    }

        /**
     * @return array|false
     */
    public function loadAllProducts(): bool|array
    {
        $sql = "SELECT * FROM ".$this->getTableName()." WHERE status = 1";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function loadOneProduct($productId): mixed
    {
        $sql = "SELECT * FROM ".$this->getTableName()." WHERE id = ?";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch();
    }

    /**
     * @return bool|array
     */
    public function getProductsAdmin(): bool|array
    {
        $sql = "SELECT * FROM product";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOneProductById($id): mixed
    {
        $sql = "SELECT * FROM ".$this->getTableName()." WHERE id = ?";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * @param $id
     */
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM ".$this->getTableName()." WHERE id = ?";
        $stmt =Connection::connect()->prepare($sql);
        $stmt->execute([$id]);
        echo '<div class="success"> Product deleted successfully!</div>';
        echo '<a class="black" href="admin_products.php">Click here if you are not redirected in 3 seconds!</a>';
        header("Refresh:1; url=admin_products.php");
    }

    /**
     * @param $updateData
     * @param $id
     */
    public function updateProduct($updateData, $id)
    {
        $sql = "UPDATE ".$this->getTableName()." SET name = ?, description =?, image = ?, price = ?, status = ? WHERE id = ?";
        $stmt =Connection::connect()->prepare($sql);
        $stmt->execute([$updateData['name'], $updateData['description'], $updateData['image'], $updateData['price'], $updateData['status'], $id]);
        echo '<div class="success"> Product updated successfully!</div>';
        echo '<a class="black" href="admin_products.php">Click here if you are not redirected in 3 seconds!</a>';
        header("Refresh:1; url=admin_products.php");
    }

    /**
     * @param $productData
     */
    public function addProduct($productData)
    {
        $sql = "INSERT INTO ".$this->getTableName()." (name, description, image, price, status) VALUES (?,?,?,?,?)";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$productData['name'], $productData['description'], $productData['image'], $productData['price'], $productData['status']]);
        echo '<div class="success"> Product added successfully!</div>';
        echo '<a class="black" href="admin_products.php">Click here if you are not redirected in 3 seconds!</a>';
        header("Refresh:2; url=admin_products.php");
    }

    public function getMostOrderedProducts(): bool|array
    {
        $sql = "SELECT * FROM ".$this->getTableName()." ORDER BY units_sold DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLeastOrderedProducts(): bool|array
    {
        $sql = "SELECT * FROM ".$this->getTableName()." ORDER BY units_sold ASC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOrderHistory() {
        $fourWeeksago = date("Y-m-d", strtotime("-4 weeks"));
        $sql = "SELECT * FROM orders WHERE date >= ? ORDER BY date DESC";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$fourWeeksago]);
        return $stmt->fetchAll();
    }
}