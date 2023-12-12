<?php
include './model/marque.php';
$marques=marque::getAll();
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
}
else{
include "./views/admin/afficher_marque.php";
}