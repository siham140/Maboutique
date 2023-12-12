<?php
include './model/sub_categorie.php';
$sousCategries = SubCategorie::getAll();
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
}
else{
include "./views/admin/sousCategorie.php";
}