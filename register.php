<?php
$title = "Registration";
$_SESSION['logged_in'] = false;
include __DIR__ . '/inc/header.php';
include_once __DIR__ . '/classes/userClass.php';
?>
    <div class="content">
        <form class="form-horizontal" method="POST" action="">
            <input type="email" class="form-control" placeholder="Your email address" name="email" required>
            <input type="password" class="form-control" placeholder="Your password" name="password" required>
            <input type="password" class="form-control" placeholder="Confirm password" name="password_confirm" required>
            <button type="submit" name="btn_reg">Register!</button>
        </form>
        <?php if (isset($_POST['btn_reg'])) {

            if ((sha1($_POST['password']) != sha1($_POST['password_confirm']))) {
                echo '<div class="alert alert-danger"> Passwords do not match</div>';
                die();
            }
            if (strlen($_POST['password']) < 8) {
                echo '<div class="alert alert-danger"> Password must be at least 8 characters long</div>';
                die();
            }
            $user = new User();
            try {
                $user->register($_POST['email'], $_POST['password']);
            } catch (Exception $e) {
                echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                die();
            }
        }
        ?>
    </div>
<?php

include __DIR__ . '/inc/footer.php';
