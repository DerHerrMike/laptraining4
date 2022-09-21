<?php
$title = "Login";
include __DIR__ . '/inc/header.php';
include './classes/userClass.php';
?>

<div class="content">

    <article>
        <h2>Login</h2>
        <br><br>
    </article>

    <div class="site-identity">
        <form class="form-signin" method="POST" action="">
            <input type="text" class="form-control" name="email" placeholder="Email">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <br><br>
</div>
<?php
if(isset($_POST['login'])) {
    $user = new User();
    $user->login($_POST['email'], sha1($_POST['password']));
}
include './inc/footer.php';
