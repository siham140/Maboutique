<?php
include "./model/commandes.php";
include "./model/categorie.php";

$categories=Categorie::getAll();
// Récupérez le hachage depuis l'URL
$url = filter_input(INPUT_GET, "url");
$reps = explode("/", $url);
$hashed_id =$reps[1];
/* $hashed_id = $_GET['id'];  */
$id_commande = hex2bin($hashed_id);

$commande = new Commande();
$commandeDetails = $commande->getCommandeDetails($id_commande);
if ($commandeDetails) {
    include "./views/detail_commande.php";
} else {
    echo "Commande non trouvée";
}
