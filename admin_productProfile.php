<?php
$title = 'Admin Product Profile';
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
$product_id = $_GET['pid'];
$product = new Product();
$name = ($product->getOneProductById($product_id)['name']);
$description = ($product->getOneProductById($product_id)['description']);
$filename = ($product->getOneProductById($product_id)['image']);
$price = ($product->getOneProductById($product_id)['price']);
$status = ($product->getOneProductById($product_id)['status'])
?>

    <div class="container">
        <br><br>
        <article>
            <h2>Admin Panel Products</h2>
        </article>
        <br><br>

        <div class="productcontent">
            <div>
                <form class="form-horizontal" method="post" action="#">
                    <input type="hidden" name="id" value="<?php $product_id; ?>"/>
                    <button type="submit" name="delete" class="">Delete Product</button>
                </form>
            </div>
            <br><br>

            <form class="form-horizontal" method="post" action="#">
                <input type="hidden" name="id" value="<?php $product_id; ?>"/>
                <table class="table">
                    <tr>
                        <td></td>
                        <td>Current</td>
                        <td>New</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td><?php echo $name; ?></td>
                        <td><input type="text" name="name" value="<?php echo $name; ?>"</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?php echo $description; ?></td>
                        <td><input type="text" name="description" value="<?php echo $description; ?>"</td>
                    </tr>
                    <tr>
                        <th>Image File Name:</th>
                        <td><?php echo $filename; ?></td>
                        <td><input type="text" name="image" value="<?php echo $filename; ?>"</td>
                    </tr>
                    <tr>
                        <th>Price:</th>
                        <td><?php echo $price; ?></td>
                        <td><input type="text" name="price" value="<?php echo $price; ?>"</td>
                    <tr>
                        <th>Status:</th>
                        <td><?php echo $status; ?></td>
                        <td><input type="number" name="status" value="<?php echo $status; ?>" min="0" max="1"</td>
                    </tr>
                    <br><br>
                </table>
                <br><br>
                <button type="submit" name="update">Update Product</button>
            </form>
            <br><br>
        </div>
    </div>

<?php
if (isset($_POST['update'])) {
    $product->updateProduct($_POST, $product_id);
}
if (isset($_POST['delete'])) {
    $product->deleteProduct($product_id);
}
include_once 'inc/footer.php';