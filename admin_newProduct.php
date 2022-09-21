<?php
$title = 'Admin New Product';
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

    <div class="container">
        <br><br>
        <article>
            <h2>Admin Panel Products</h2>
        </article>
        <br><br>

        <div class="productcontent">

            <div>
                <form class="form-horizontal" method="post" action="#">
                    <table class="table">
                        <tr>
                            <th>Name:</th>
                            <td><input type="text" name="name"</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td><input type="text" name="description"</td>
                        </tr>
                        <tr>
                            <th>Image File Name:</th>
                            <td><input type="text" name="image"</td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td><input type="text" name="price"</td>
                        <tr>
                            <th>Status:</th>
                            <td><input type="text" name="status" placeholder="0 = inactive, 1 = active"</td>
                        </tr>
                    </table>
                    <br><br>
                    <button type="submit" class="add" name="add_product">Add New Product</button>
                </form>
            </div>
            <br><br>
        </div>
    </div>


<?php
$product = new Product();
if (isset($_POST['add_product'])) {
    $product->addProduct($_POST);
}
include __DIR__ . '/inc/footer.php';
?>