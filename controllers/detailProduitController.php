<?php
include "./model/produit.php";
include "./model/panier.php";
include "./model/categorie.php";

$categories = Categorie::getAll();
$slug = filter_input(INPUT_GET, "s");
$produit = Produit::getProductBySlug($slug);

$message = ""; // Initialisation de la variable de message

if (isset($_POST['submit'])) {
    $id_produit = filter_input(INPUT_POST, "id_produit", FILTER_VALIDATE_INT);
    $quantite = 1; // Par défaut, une quantité de 1
    $quantite = intval($quantite);

    $panier = new Panier();
    $panier->ajouterAuPanier($id_produit, $quantite);

    // Définition du message de succès
    $message = "<div class='message' id='message-container'>
    <div class='message_content'>
        <p class='text-success'>Produit ajouté au panier avec succès</p>
        <p>Vous souhaitez voir votre panier ou continuer vos achats ?</p>
        <a class='marge-droite text-black' id='continue-shopping-button'><i class='bi bi-chevron-double-left'></i>Continuer vos achats</a>
        <button id='view-cart-button' class='btn btn-warning'>Voir le panier</button>
        <button id='fermer'><i class='bi bi-x-lg'></i></button>
    </div>
</div>";
}

include "./views/detail.php";
