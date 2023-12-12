<?php
include './model/categorie.php';
$categories=Categorie::getAll();
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
}
else{
include "./views/admin/categories.php";
}