<?php
$title = 'Product';
include __DIR__ . '/inc/head.php';
$product_id = $_GET['pid'];
include 'classes/productClass.php';
include 'classes/cartClass.php';

if (!isset($_SESSION['logged_in'])) { ?>

    <div class="cont">
        <article>
            <h2>Product Details</h2>
        </article>

        <table class="cont-table-tiny">
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <?php
            $product = new Product();
            $result = $product->loadOneProduct($product_id);
            $tmp = number_format($result['price'], 2, ",", ".");
            ?>
            <tr>
                <td> <?php echo $result['name'] ?></td>
                <td><img class="image" src="../ressources/<?php echo $result['image'] ?>"</td>
                <td><?php echo $result['description'] ?></td>
                <td> <?php echo 'EUR ' . $tmp ?></td>
            </tr>
        </table>
        <br><br>
        <div class="info">
            <p>Please log in to add items to your shopping cart!</p>
        </div>
    </div>
<?php } else { ?>
    <div class="cont">
        <article>
            <h2>Product Details</h2>
        </article>

        <table class="cont-table-tiny">
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
            $tmp = number_format($result['price'], 2, ",", ".");
            ?>
            <tr>
                <td> <?php echo $result['name'] ?></td>
                <td><img class="image" src="../ressources/<?php echo $result['image'] ?>"></td>
                <td><?php echo $result['description'] ?></td>
                <td> <?php echo 'EUR ' . $tmp ?></td>
                <td>
                    <form action='#' method='post'>
                        <input type='hidden' name='name' value=" <?php echo $result['name'] ?>">
                        <input type='hidden' name='price' value=" <?php echo $result['price'] ?>">
                        <input type='number' name='quantity' min="1" max="99" value="1">
                        <button type='submit' name='add_btn'>Add to Cart</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>


<?php }
if (isset($_POST['add_btn'])) {
    $cart = new Cart();
    try {
        $cart->addToCart($_SESSION['user_id'], $product_id, $_POST['name'], $_POST['price'], $_POST['quantity']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
include 'inc/footer.php'; ?>