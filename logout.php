<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['logged_in']);
unset($_SESSION['user_role']);
session_destroy();
header("Location:index.php");