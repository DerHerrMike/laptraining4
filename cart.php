<?php
$title = 'Cart';
include __DIR__ . '/inc/header.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    header("Refresh:2; Location:login.php");
}
include 'classes/productClass.php';
include 'classes/cartClass.php';
$cart = new Cart();
$resultSet = $cart->loadCartItemsbyUser($_SESSION['user_id']);
$grandTotal = 0;
?>
    <div class="content">
    <article>
        <h2>Cart Overview</h2>
    </article>
    <br><br>
    <div class="container_small">
<?php if ($resultSet) { ?>
    <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 2px;">
        <tr>
            <th>Name</th>
            <th>Price per unit</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Delete Item</th>
        </tr>
        <?php foreach ($resultSet as $result) {
            $total_price = $result['quantity'] * $result['product_price'];
            $grandTotal = $grandTotal + $total_price;
            ?>
            <tr>
                <td><?php echo $result['product_name'] ?></td>
                <td>EUR <?php echo $result['product_price'] ?></td>
                <td><?php echo $result['quantity'] ?></td>
                <td>EUR <?php echo $total_price ?></td>
                <td>
                    <form action="" method="post">
                        <button type="submit" name="delete" value=" <?php echo $result['product_id'] ?> "><span
                                    class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        } ?>
        <tr>
            <td> Grand Total:</td>
            <td></td>
            <td></td>
            <td>EUR <?php echo $grandTotal ?> </td>
    </table>

    <div class="productcontent">
        <form action="#" method="post">
            <button type="submit" name="order">Order now</button>
        </form>
    </div>
    </div>
    <br><br>
    </div>
<?php } else { ?>
    <br><br>
    <div class="info">Your cart is currently empty!</div>
    </div>
    <br><br>
    </div>
<?php } ?>

<?php
if (isset($_POST['order'])) {
    $date = date('Y-m-d H:i:s');
    $cart->order($_SESSION['user_id'], $date);
}
if (isset($_POST['delete'])) {
    $cart->removeItemFromCart($_SESSION['user_id'], $_POST['delete']);
}
include 'inc/footer.php';
?>