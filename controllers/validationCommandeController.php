<?php
// Incluez vos classes et fichiers nécessaires
include "./model/produit.php";
include "./model/categorie.php";
include "./model/panier.php";
include "./model/commandes.php";

// Récupérez les données du formulaire de commande
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$quantite = filter_input(INPUT_POST, "quantite", FILTER_VALIDATE_INT);
$id_users = filter_input(INPUT_GET, "id_users", FILTER_VALIDATE_INT);
$paiement = filter_input(INPUT_POST, "paiement", FILTER_SANITIZE_STRING);
$categories = Categorie::getAll();

// if (isset($id) && isset($quantite)) {
//     $produit = new Produit();
//     // Réduisez le stock du produit en conséquence
//     $produit = Produit::getProductById($id);
//     if ($produit) {
//         $nouveauStock = $produit->getStock() - $quantite;
//         // Mettez à jour le stock du produit dans la base de données

//         $produit = $produit->updateStockProduit($id, $nouveauStock);
//     }

//     // Répondez avec un message de succès ou d'erreur selon le cas
//     echo "Commande validée avec succès";
// } else {
//     // Gérez les requêtes non valides
//     echo "Requête invalide";
// }

if (isset($_POST['valider'])) {
    if ($paiement === "paypal") {
        // Traitement pour le paiement PayPal
        // echo "Paiement via PayPal effectué.";
    } elseif ($paiement === "carte bancaire") {
        // Traitement pour le paiement par carte de crédit
        // echo "Paiement par carte de crédit effectué.";
    } elseif ($paiement === "virement bancaire") {
        // Traitement pour le virement bancaire
        // echo "Paiement par virement bancaire effectué.";
    } else {
        //le cas où aucun moyen de paiement n'est sélectionné
        echo "Veuillez sélectionner un moyen de paiement valide.";
    }

    if (isset($_SESSION["logged"]) && ($_SESSION["logged"])) {
        $id_users = $_SESSION['id'];
       
        $quantite = 0;
        if (isset($_SESSION['validation_panier'])) {
            $panier = $_SESSION['validation_panier'];
            $totalProduit = 0;
            $total = 0;
            foreach ($panier as $item) {
                $quantite = $item['quantite'];
                $totalProduit += $item['prix'] * $quantite;
                $total += $item['totalProduit'];
            }
            
            $commande = new Commande();
            $commandes = $commande->ajouterCommande($id_users, $total, $panier, $paiement);
            
            // Effacer le panier après toutes les commandes réussies
            $_SESSION['panier'] = [];
            
            $panierD = new Panier();
            $panierDelete = $panierD->supprimerPanier($id_users);
           include "./views/confirmation-commande.php" ;
        }
        
    }
    }
