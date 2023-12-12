<?php
session_start();
$url = filter_input(INPUT_GET, "url");
$reps = explode("/", $url);

switch ($reps[0]) {
    case "":
        include "nouveauteController.php";
        break;
    case "recherche":
        include "rechercheController.php";
        break;
        //users
    case "inscription":
        include "inscriptionController.php";
        break;
    case "admin":
        include "authentificationAdminController.php";
        break;
    // case "passwordForgot":
    //     include "./views/passwordForgot.php";
    //     include "forgotController.php";
    //     break;
    case "update-adress":
        include "updateAdressController.php";
        break;
        /* case "validationPass":
        include "forgotController.php";
        break; */
    case "validationPass":
        include "validationPassController.php";
        // include "initialisationPassController.php";
        break;
    case "connexion":
        include "connexionController.php";
        break;
    case "deconnexion":
        include "./views/deconnexion.php";
        break;
           //admin
    case "add-user":
        include "addUserController.php";
        break;
    case "update-user":
        include "modifierUserController.php";
        break;
    case "afficher_user":
        include "afficherUserController.php";
        break;
    case "supprimer_user":
        include "deleteUserController.php";
        break;
    case "dashboard":
        include "dashboardController.php";
        break;
    case "dashboard-admin":
        include "./views/admin/dashboard-admin.php";
        break;
    case "deconnexion-admin":
        include "./views/deconnexion-admin.php";
        break;
        //categorie
    case "add-categorie":
        include "addCategorieController.php";
        break;
    case "update-categorie":
        include "modifierCategorieController.php";
        break;
    case "categories":
        include "afficherCategorieController.php";
        break;
    case "supprimer-categories":
        include "supprimerCatController.php";
        break;
        //sub_categorie
    case "add-subcategorie":
        include "addSubCategorieController.php";
        break;
    case "update-subcategorie":
        include "modifierSubCatController.php";
        break;
    case "sous-categories":
        include "afficherSubCatController.php";
        break;
    case "supprimer-subcategories":
        include "supprimerSubCatController.php";
        break;
        //produit
    case "add-produit":
        include "addProduitController.php";
        break;
    case "afficher_produit":
        include "afficherProduitController.php";
        break;
    case "update-produit":
        include "modifierProduitController.php";
        break;
    case "supprimer_produit":
        include "supprimerProduitController.php";
        break;
    case "detail":
        include "detailProduitController.php";
        break;
    case "produitByCat":
        include "produitByCatController.php";
        break;
    case "filtreProduit":
        include "filtreProduitController.php";
        break;
    case "promotion":
        include "produitPromotionController.php";
        break;
    case "nouveaute":
        include "nouveauteController.php";
        break;
        //marque
    case "add-marque":
        include "addMarqueController.php";
        break;
    case "update-marque":
        include "modifierMarqueController.php";
        break;
    case "marques":
        include "afficherMarqueController.php";
        break;
    case "supprimer-marques":
        include "supprimerMarqueController.php";
        break;
        //Panier
    case "panier":
        include "panierController.php";
        break;
    case "ajouterPanier":
        include "ajouterPanierController.php";
        break;
    case "updatePanier":
        include "./views/updatePanier.php";
        break;
    case "updateQuantiteTotale":
        include "./views/updateQuantiteTotale.php";
        break;
    case "updateSessionQuantite":
        include "./views/updateSessionQuantite.php";
        break;
    case "valider_panier":
        include "validationPanierFinal.php";
        break;
    case "validation-panier":
        include "validationPanierController.php";
        break;
    case "check_panier":
        include "checkPanierController.php";
        break;
    case "supprimer_produit_panier":
        include "supprimerProduitPanierController.php";
        break;
    case "getTotalProducts":
        include "./views/getTotalProducts.php";
        break;
    case "checkout_livraison":
    include "checkLivaisonController.php";;
        break;
    case "paiement":
        include "paiementController.php";
            break;
        //Commande
    case "creer_commande":
        include "creerCommandeController.php";
        break;
    case "commandes":
        include "listCommandeController.php";
        break;
    case "commandesByUser":
        include "commandesByUserController.php";
        break;
    case "detail_commande":
        include "detailCommandeController.php";
        break;
    case "panier_vide":
        include "panierVideController.php";
        break;
    case "valider_commande":
        include "validationCommandeController.php";
        break;
        //assets
    case "assets":
        header("Content-type: text/css");
        require "assets/$reps[1]";
        break;
    case "js":
        header("Content-type: text/javascript");
        require "./public/js/$reps[1]";
        break;
    case "images":
        header("Content-type: image/webp");
        include "./public/upload/images/$reps[1]";
        break;
    case "images":
        header("Content-type: image/jpej");
        include "./public/upload/images/$reps[1]";
        break;
    // page 404
    default:
        include "./views/404.html";
}
