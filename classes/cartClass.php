<?php
require_once __DIR__ . '/../inc/connection.php';

class Cart extends Connection
{

    /**
     * @param $user_id
     * @param $product_id
     * @param $product_name
     * @param $price
     * @param $quantity
     */
    public function addToCart($user_id, $product_id, $product_name, $price, $quantity)
    {

        $sql = "SELECT * FROM laptraining4.cart WHERE product_id = ? AND user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product_id, $user_id]);
        $result = $stmt->fetchAll();
        if (count($result) == 0) {
            $sql = 'INSERT INTO laptraining4.cart (user_id, product_id, product_name, product_price, quantity) VALUES (?,?, ?, ?,?)';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $product_id, $product_name, $price, $quantity]);
            echo 'Item added successfully';
            header('Refresh:2; url=shop.php');
        } else {
            $this->updateQuantity($quantity, $product_id, $user_id);
        }
    }

    /**
     * @param $quantity
     * @param $product_id
     * @param $user_id
     */
    private function updateQuantity($quantity, $product_id, $user_id)
    {
        $sql = 'UPDATE laptraining4.cart SET quantity = quantity + ? WHERE product_id = ? AND user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quantity, $product_id, $user_id]);
        echo 'Quantity updated';
        header('Refresh:2; url=shop.php');
    }

    /**
     * @param $user_id
     * @return bool|array
     */
    public function loadCartItemsbyUser($user_id): bool|array
    {
        $sql = 'SELECT * FROM laptraining4.cart WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    /**
     * @param $user_id
     * @param $date
     */
    public function order($user_id, $date)
    {
        $sql = 'SELECT * FROM laptraining4.cart WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        foreach ($result as $row){
            $sql = 'INSERT INTO laptraining4.orders (user_id, product_id, product_name, product_price, quantity, date) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $row['product_id'], $row['product_name'], $row['product_price'], $row['quantity'], $date]);
            $this->updateUnitsSold($row['quantity'], $row['product_id']);
        }
        $this->emptyCart($user_id);

        header('Refresh: 1; url=order.php');

    }

    /**
     * @param $user_id
     */
    private function emptyCart($user_id)
    {
        $sql = 'DELETE FROM laptraining4.cart WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
    }

    /**
     * @param $quantity
     * @param $product_id
     */
    private function updateUnitsSold($quantity, $product_id)
    {
        $sql = 'UPDATE laptraining4.product SET units_sold = units_sold + ? WHERE id =?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quantity, $product_id]);
    }

    /**
     * @param $user_id
     * @param $product_id
     */
    public function removeItemFromCart($user_id, $product_id)
    {

        $sql = 'DELETE FROM cart WHERE user_id = ? AND product_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
        header('Refresh:5; url=cart.php');
    }

}