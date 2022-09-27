<?php
$title = 'Order';
include __DIR__ . '/inc/head.php';
if (!isset($_SESSION['logged_in'])) {
    echo "<div class='alert'>You have to be logged in to see this page!</div>";
    header("Refresh:2; url=login.php");
}
include __DIR__ . '/classes/userClass.php';
?>

<div class="cont">

    <article>
        <h2>User profile</h2>
    </article>

    <br><br>
    <p>Please enter / update your details here</p>
    <br><br>

    <form action="" method="post">
        <input type="text" name="first_name" placeholder="First name" required>
        <input type="text" name="last_name" placeholder="Last name" required>
        <input type="text" name="street" placeholder="Street" required>
        <input type="text" name="number" placeholder="Number" required>
        <input type="text" name="zip" placeholder="zip code" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="country" placeholder="Country" required>
        <br><br>
        <button type="submit" name="user_details_btn">Submit details! </button>
    </form>

</div>

<?php
if (isset($_POST['user_details_btn'])) {
    $user = new User();
    $user->updateUserDetails($_SESSION['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['street'], $_POST['number'], $_POST['zip'], $_POST['city'], $_POST['country']);
}
include 'inc/footer.php';
?>