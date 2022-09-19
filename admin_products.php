<?php
$title = 'Admin Product Panel';
include __DIR__ . '/inc/header.php';
include __DIR__ . '/classes/productClass.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    header("Refresh:2; url=login.php");
}
if ($_SESSION['user_role'] != 'admin') {
    echo "<div class='alert'>You don't have permission to view this page!</div>";
    header("Refresh:2; url=login.php");
}
?>

    <div class="content">
    <br><br>
    <article>
        <h2>Admin Panel Products</h2>
    </article>
    <br><br>

    <div class="site-identity">

    <div>
        <form class="form-horizontal" method="post" action="newProduct.php">
            <button type="submit" name="newProduct" class="">Add Product</button>
        </form>
    </div>
    <br><br>

    <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 10px;">

    <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image File Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Manage</th>
    </tr>
<?php
$product = new Product();
$result = $product->getProductsAdmin();
foreach ($result

    as $product) { ?>
    <tr>
    <td><?php echo $product['id']; ?></td>
    <td><?php echo $product['name']; ?></td>
    <td><?php echo $product['description']; ?></td>
    <td><?php echo $product['image']; ?></td>
    <td><?php echo $product['price']; ?></td>
    <td><?php echo $product['status']; ?></td>
    <td><a href="productProfile.php?pid=<?php $product['id'] ?>">edit product</a></td>


<?php } ?>


<?php
include_once 'inc/footer.php'; ?>