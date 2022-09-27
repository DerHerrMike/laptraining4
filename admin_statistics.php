<?php
$title = 'Admin Panel User';
include __DIR__ . '/inc/head.php';
include __DIR__ . '/classes/productClass.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    echo '<a class="black" href="login.php">Click here if you are not redirected in 3 seconds!</a>';
    header("Refresh:2; url=login.php");
    die();
}
if (!empty($_SESSION)) {
    if ($_SESSION['user_role'] != 'admin') {
        echo "<div class='alert'>You don't have permission to view this page!</div>";
        echo '<a class="black" href="login.php">Click here if you are not redirected in 3 seconds!</a>';
        header("Refresh:2; url=login.php");
        die();
    }
}
$product = new Product();
?>

<div class="cont">

    <article>
        <h2>Admin Panel Products</h2>
    </article>
    <br><br>
    <div><p>Please select relevant statistic</p></div>
    <br><br>
    <div class="row">
        <form method= "post" action="#">
            <button type="submit" class="" value="most" name="most">Most</button>
            <button type="submit" class="" value="least" name="least">Least</button>
            <button type="submit" class="" value="weeks" name="weeks">Weeks</button>
        </form>
    </div>
    <br><br>

    <?php if(isset($_POST["most"]) || (isset($_POST['least'])) || isset($_POST['weeks'])) { ?>
       <table class="cont-table-tiny">
            <tr>
                <th>Product ID</th>
                <th>Name</th>

    <?php if (isset($_POST['most'])) {
    $result = $product->getMostOrderedProducts(); ?>
                <th>Units sold</th>
            </tr>
            <tr>
                <?php foreach ($result as $item) { ?>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['units_sold']; ?></td>
            </tr>
            <?php }
    } if (isset($_POST['least'])){
    $result = $product->getLeastOrderedProducts();?>

                   <th>Units sold</th>
                </tr>
                <tr>
                    <?php
                    foreach ($result as $item) { ?>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['units_sold']; ?></td>
                </tr>
                <?php }
    } if(isset($_POST['weeks'])) {
    $result = $product->getOrderHistory();?>

                <th>Date ordered</th>
            </tr>
            <tr>
                <?php
                foreach ($result as $item) { ?>
                <td><?php echo $item['product_id']; ?></td>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['date'] ?></td>
            </tr>
            <?php } } } ?>
        </table>

    <br><br>
</div>

<?php
include __DIR__ . '/inc/footer.php';