<?php
$title = 'Admin Product Panel';
include __DIR__ . '/inc/head.php';
include __DIR__ . '/classes/productClass.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    echo '<a class="black" href="login.php">Click here if you are not redirected in 3 seconds!</a>';
    header("Refresh:2; url=login.php");
    die();
}
if ($_SESSION['user_role'] != 'admin') {
    echo "<div class='alert'>You don't have permission to view this page!</div>";
    echo '<a class="black" href="login.php">Click here if you are not redirected in 3 seconds!</a>';
    header("Refresh:2; url=login.php");
    die();
}
?>

    <div class="cont">
        <article>
            <h2>Admin Panel Products</h2>
        </article>
        <br><br>


        <form class="form-horizontal" method="post" action="admin_newProduct.php">
            <button type="submit" name="newProduct" class="">Add Product</button>
        </form>


        <table class="cont-table-low">

        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image File Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>

        <tr>
            <?php
            $product = new Product();
            $result = $product->getProductsAdmin();

            foreach ($result

            as $product) {
            $tmp = number_format($product['price'], 2, ",", "."); ?>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['image']; ?></td>
            <td><?php echo $tmp; ?></td>
            <td><?php echo $product['status']; ?></td>
            <td><a class="table" href="admin_productProfile.php?pid=<?php echo $product['id'] ?>">edit product</a></td>
        </tr>
        <?php } ?>
        </table>
        <br><br>
    </div>

<?php
include_once 'inc/footer.php'; ?>