<?php
$title = 'Admin Panel User';
include __DIR__ . '/inc/header.php';
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
    <div><p>This page is a stub</p></div>
</div>

<?php
include __DIR__ . '/inc/footer.php';