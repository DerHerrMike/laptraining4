<?php
require_once __DIR__ . '/../inc/connection.php';

class User
{

    private function getTableName(): string
    {
        return "user";
    }

    /**
     * @throws Exception
     */
    public function register($email, $password)
    {
        if (!$this->isEmailavailable($email)) {
            echo '<div class="alert alert-danger"> User with email: ' . $email . ' already exists! </div>';
            return false;
        }
        $sql = "INSERT INTO " . $this->getTableName() . " (email, password) VALUES (?,?)";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$email, $password]);
        echo '<div class="success"> Registration successful!</div>';
        echo '<a class="black" href="login.php">Click here if you are not redirected in 3 seconds!</a>';
        header("Refresh:3; url=login.php");
        return true;
    }

    /**
     * @param $email
     * @return bool
     */
    private function isEmailavailable($email): bool
    {
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE email = ?";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @param $password
     */
    public function login($email, $password)
    {
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE email = ?";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        if (!$result) {
            echo '<div class="alert alert-danger">Email: ' . $email . ' not registered! </div>';
            return;
        }
        if ($result['password'] != $password) {
            echo '<div class="alert alert-danger">Password not recognized</div>';
        } else {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = $result['role'];
            $_SESSION['user_id'] = $result['id'];
            if (empty($result['zip'])) {
                $_SESSION['user_details'] = false;
            } else {
                $_SESSION['user_details'] = true;
            }
            echo '<a class="black" href="shop.php">Click here if you are not redirected in 3 seconds!</a>';
            header('Refresh:1; url=shop.php?');
        }
    }

    /**
     * @param $user_id
     * @param $first_name
     * @param $last_name
     * @param $street
     * @param $number
     * @param $zip
     * @param $city
     * @param $country
     */
    public function updateUserDetails($user_id, $first_name, $last_name, $street, $number, $zip, $city, $country)
    {
        $sql = "UPDATE " . $this->getTableName() . " SET first_name = ?, last_name = ?, street = ?, number = ?, zip = ?, city = ?, country = ? WHERE id = ?";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute([$first_name, $last_name, $street, $number, $zip, $city, $country, $user_id]);
        $_SESSION['user_details'] = true;
        echo '<div class="success"> User data saved successfully! </div>';
        echo '<a class="black" href="order.php">Click here if you are not redirected in 3 seconds!</a>';
        header('Refresh:1; url=order.php');
    }
}