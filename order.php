<?php
$title = 'Order';
include __DIR__ . '/inc/header.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    header("Refresh:2; url=login.php");
}
include __DIR__ . '/classes/userClass.php';
?>

<div class="content">
    <br><br>
    <article>
        <h2>Order</h2>
    </article>

    <?php
    if ($_SESSION['user_details'] == false){ ?>

    <div class="container_small">
        <p>Please enter your delivery details</p>
    </div>
    <div class="container_small">
        <form action="" method="post">
            <input type="text" name="first_name" placeholder="First name" required>
            <input type="text" name="last_name" placeholder="Last name" required>
            <input type="text" name="street" placeholder="Street" required>
            <input type="text" name="number" placeholder="Number" required>
            <input type="text" name="zip" placeholder="zip code" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="country" placeholder="Country" required>
            <button type="submit" name="user_details_btn">Register!</button>
        </form>
    </div>
</div>

<?php } else { ?>
    <div class="container_small">
        <form method="post" action="#" id="payment">
            <label for="payment">Choose payment option</label>
            <select name="payment" id="payment">
                <option value="">SELECT</option>
                <option value="Apple Pay">Apple Pay</option>
                <option value="Card">Card</option>
                <option value="Crypto">Crypto</option>
                <option value="Invoice">Invoice</option>
                <option value="Paypal">Paypal</option>
            </select>
            <button type="submit" name="payment_btn" id="payment" class="reg_btn">Confirm Payment</button>
        </form>
    </div>
    </div>
<?php } ?>

<?php if (isset($_POST['payment_btn'])) { ?>
    <div class="info">
        <p>Payment with <?php echo $_POST['payment'] ?> okay!</p>
    </div>
<?php }
if (isset($_POST['user_details_btn'])) {
    $user = new User();
    $user->updateUserDetails($_SESSION['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['street'], $_POST['number'], $_POST['zip'], $_POST['city'], $_POST['country']);
}
include 'inc/footer.php';
?>

