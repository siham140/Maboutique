<?php
include('./model/produit.php');
include('./model/categorie.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (isset($id)) {
    $produit = Produit::getProductById($id);
    $produit->SupprimerProduits($id);
    if ($produit) {
        // Rediriger vers la page de succès ou afficher un message de succès
        header("Location: afficher_produit");
        exit;
}
}
