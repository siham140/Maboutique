<?php
include "./model/commandes.php";
include "./model/categorie.php";
$categories=Categorie::getAll();
$bytes = openssl_random_pseudo_bytes(255);
$hex   = bin2hex($bytes);
if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
    $id_users=$_SESSION['id'];
$commandes=new Commande();
$commandes=$commandes->listCommandesByUser($id_users);
}
include "./views/commandesByUser.php";