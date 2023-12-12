<?php
include "./model/commandes.php";
include "./model/categorie.php";
$id_commande=filter_input(INPUT_GET,"id_commande", FILTER_VALIDATE_INT);
$categories=Categorie::getAll();

$detailcommandes=new Commande();
$detailcommandes=$detailcommandes->getCommandeDetails($id_commande);
// include "./views/confirmation-commande.php";
