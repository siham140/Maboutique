<?php
include('./model/users.php');
$users = Users::listAll();
$bytes = openssl_random_pseudo_bytes(24);
$hex   = bin2hex($bytes);
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    include "./views/admin/afficher_user.php";
}
