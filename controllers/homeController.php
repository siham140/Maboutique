<?php
include_once "./model/produit.php";
include_once "./model/categorie.php";
include_once "./model/sub_categorie.php";
$categories = Categorie::getAll();
$subcategories = SubCategorie::getAll();
$produits = Produit::getAll();
include "./views/index.php";
