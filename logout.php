<?php
session_start();
$name=$_SESSION['user'];
$cook='username';
setcookie($cook, $name, time() + (86400 * 30), "/");
unset($_SESSION['user']);
session_destroy();
header("location:index.php");?>