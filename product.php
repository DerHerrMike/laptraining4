<?php
$title = 'Product';
include __DIR__ . '/inc/header.php';
if(!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    header("Refresh:2; Location:login.php");
}
$product_id = $_GET['pid'];
include 'classes/productClass.php';
?>
    <div class="content">

        <div class="container_small">

            <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 10px;">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>

    <?php
    $product = new Product();
    $result = $product->loadOneProduct($product_id);
    ?>
                <tr>
                    <td> <?php echo $result['name'] ?></td>
                    <td><img class="image" src="../ressources/<?php echo $result['image'] ?>"</td>
                    <td><?php echo $result['description'] ?></td>
                    <td> EUR <?php echo $result['price'] ?></td>
                    <td>
                        <form action='#' method='post'>
                            <input type='hidden' name='name' value=" <?php echo $result['name'] ?>">
                            <input type='hidden' name='price' value=" <?php echo $result['price'] ?>">
                            <input type='number' name='quantity'>
                            <button type='submit' name='add_btn'>Add to Cart</button>
                        </form>
                </tr>
            </table>
        </div>

    </div>



<?php
if(isset($_POST['add_btn'])){
$cart = new Cart();
$cart->addToCart($_SESSION['user_id'], $product_id, $_POST['name'], $_POST['price'], $_POST['quantity']);

}
include   './inc/footer.php'; ?>