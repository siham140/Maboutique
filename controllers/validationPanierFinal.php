<?php
include "./model/produit.php";
include "./model/categorie.php";
include "./model/panier.php";
include "./model/commandes.php";

    // Récupérez les données du formulaire de commande
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $quantite =  filter_input(INPUT_POST, "quantite", FILTER_VALIDATE_INT); 
    $total= filter_input(INPUT_POST, "total", FILTER_VALIDATE_INT); 
    if (isset($id) && isset($quantite)) {
    $produit=new Produit();
    // Réduisez le stock du produit en conséquence
    $produit =Produit::getProductById($id);
    if ($produit) {
        $nouveauStock = $produit->getStock() - $quantite;
        // Mettez à jour le stock du produit dans la base de données
       
        $produit=$produit->updateStockProduit($id, $nouveauStock);
    }

    // Répondez avec un message de succès ou d'erreur selon le cas
    echo "Commande validée avec succès";
} else {
    // Gérez les requêtes non valides
    echo "Requête invalide";
}
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

if (isset($_POST['vider'])) {
    $_SESSION['panier'] = array();

    // Redirigez l'utilisateur vers panier_vide
    $message = "<div class='message' id='message-container'>
    <div class='message_content'>
        <p>Votre panier a été vidé avec succès</p>
        <p><a href='/' class='text-black'>Retour à la page d'accueil</a></p>
        <button id='fermer'><i class='bi bi-x-lg'></i></button>
    </div>
    </div>";
   // Rediriction de l'utilisateur vers check_panier
   header('Location: panier');
   exit();
} elseif (isset($_POST['valider'])) {
    if (isset($_SESSION["logged"]) && ($_SESSION["logged"])) {
        $id_users = $_SESSION['id'];
        $quantite = 0;
        $panier = new Panier();
        $panierProduits = $panier->getPanierProduits();
        $validationPanier = $panier->validationPanier($panierProduits, $id_users);
        // Rediriction de l'utilisateur vers check_panier
        header('Location: check_panier');
        exit();
    }
}

