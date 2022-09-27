<?php
$title = "Shop";
include __DIR__ . '/inc/head.php';
include 'classes/productClass.php';
$product = new Product();
?>
    <div class="cont">
        <article>
            <h2>Shop</h2>
        </article>
            <table class="cont-table-low" >
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                </tr>
                <?php $allProducts = $product->loadAllProducts();
                foreach ($allProducts as $product) { ?>
                    <tr>
                        <td><a class="link"
                               href="product.php?pid=<?php echo $product['id']; ?>"><?php echo $product['name'] ?></a>
                        </td>
                        <td><a class="link"
                               href="product.php?pid=<?php echo $product['id']; ?>">
                                <img class="image" src="/ressources/<?php echo $product['image'] ?>"></a></td>
                        <td><a class="link"
                               href="product.php?pid=<?php echo $product['id']; ?>">EUR <?php $tmp = number_format($product['price'], 2, ",", "."); echo $tmp;?></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <br><br>
        </div>

<?php
include './inc/footer.php';
