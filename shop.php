<?php
$title = "Shop";
include './inc/header.php';
include 'classes/productClass.php';
$product = new Product();

?>
<div class="container">
    <br><br>
    <div class="productcontent">
        <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 10px;">

            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>

            </tr>

            <?php $allProducts = $product->loadAllProducts();
            foreach ($allProducts as $product) { ?>
                <tr>
                    <td><a class="link"
                           href="product.php?pid=<?php echo $product['id']; ?>"><?php echo $product['name'] ?></a></td>
                    <td><a class="link"
                           href="product.php?pid=<?php echo $product['id']; ?>">
                           <img class="image" src="/ressources/<?php echo $product['image'] ?>"></a></td>
                    <td><a class="link"
                           href="product.php?pid=<?php echo $product['id']; ?>">EUR <?php echo $product['price'] ?></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br><br>
    </div>
</div>

<?php
include './inc/footer.php';
