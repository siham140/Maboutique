<?php
include "./model/produit.php";
include "./model/panier.php";
include "./model/categorie.php";
$id_users = filter_input(INPUT_POST, "id_users", FILTER_VALIDATE_INT);
$categories = Categorie::getAll();
$panierManager = new Panier();
$panier = $panierManager->getPanierProduits();

$id_produit = filter_input(INPUT_POST, "id_produit", FILTER_VALIDATE_INT);
$action = filter_input(INPUT_POST, "action", FILTER_DEFAULT);

if (isset($action) && !empty($action)) {
    if ($action === 'ajouter') {
        $panierManager->mettreAJourQuantite($id_produit, 1);
    } elseif ($action === 'retirer') {
        $panierManager->mettreAJourQuantite($id_produit, -1);
    }
}
// Incluez la vue du panier une fois que les traitements sont effectués.
include './views/panier.php';




