<?php
include "./model/produit.php";
include "./model/categorie.php";
$categories = Categorie::getAll();
$produits=Produit::getProductsWithDiscount();
include "./views/promotion.php";