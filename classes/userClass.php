<?php
include_once __DIR__ . '/../inc/connection.php';

class User extends Connection
{
    /**
     * @throws Exception
     */
    public function register($email, $password)
    {
        if (!$this->isEmailavailable($email)) {
            echo '<div class="alert alert-danger"> User with email: ' . $email . ' already exists! </div>';
            return false;
        }
        $sql = "INSERT INTO user (email, password) VALUES (?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $password]);
        echo '<div class="success"> Registration successful!</div>';
        header("Refresh:2; url=login.php");
    }

    public function isEmailavailable($email): bool
    {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {

        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        if (!$result) {
            echo "Email not found";
            return;
        }
        if ($result['password'] != $password) {
            echo "Passwords do not match";
        } else {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_role'] = $result['role'];
            $_SESSION['user_id'] = $result['id'];
            if (empty($result['zip'])) {
                $_SESSION['user_details'] = false;
            } else {
                $_SESSION['user_details'] = true;
            }
            header('Refresh:4; url=shop.php?' . $_SESSION['user_id']);
        }
    }


}