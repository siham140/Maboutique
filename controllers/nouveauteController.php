<?php
include "./model/produit.php";
include "./model/categorie.php";
$categories = Categorie::getAll();

$produitCarosel=Produit::getProductsWithDiscount3();
$produits=Produit::getNewProduct();
include "./views/index.php";
