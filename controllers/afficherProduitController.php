<?php
include './model/produit.php';
include './model/sub_categorie.php';
include './model/marque.php';

if ($_SESSION["role"] != "admin") {
    header('location:../views/404.html');
}
else{
    $produits = Produit::getProductByStock();
$marques = Marque::getAll();
include "./views/admin/afficher_produit.php";
}