<div class="nav">

    <div class="textlogo">
        <a href="/laptraining4/index.php">LAP Shop</a>
    </div>

    <div class="mainlinks">
        <a href="/laptraining4/shop.php">Shop</a>
        <a href="/laptraining4/contact.php">Contact</a>
        <?php if (isset($_SESSION['logged_in'])) {
            ?> <a href="/cart.php">Cart</a>
        <?php } ?>
    </div>

    <div class="userlinks">
        <?php
        if(isset($_SESSION['logged_in'])) {
           ?>
                <a href="/laptraining4/admin.php">Admin Panel</a>
                <a href="/laptraining4/logout.php">Logout</a>
            <?php } elseif($_SESSION['user_role'] == 'admin') { ?>
                <a href="/laptraining4/profile.php">Profile</a>
                <a href="/laptraining4/logout.php">Logout</a>
        <?php } else { ?>
        <a href="/laptraining4/login.php">Login</a>
        <a href="/laptraining4/register.php">Register</a>
        <?php } ?>

    </div>

</div>