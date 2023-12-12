<?php
include "./model/produit.php";
include './model/categorie.php';
$categories=Categorie::getAll();

// Vérifiez si un terme de recherche est présent dans l'URL
$recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($recherche)) {
    $resultats= Produit::rechercherProduits($recherche);
    $marques=Produit::getProduitMarque($slug_categorie);
}
include "./views/recherche.php"; 


