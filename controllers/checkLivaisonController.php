<?php
include "./model/categorie.php";
include "./model/panier.php";
$categories=Categorie::getAll();
if (isset($_SESSION["logged"]) && $_SESSION["logged"]) {
    $id = $_SESSION["id"];
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $adresse = $_SESSION["adresse"];
    $ville = $_SESSION["ville"];
    $code_postale = $_SESSION["code_postale"];
    
    // Ensuite, passez ces données à la vue
    include("./views/checkout_livraison.php");
} else {
    // Gérez le cas où la session "logged" n'est pas définie ou est fausse
    // Vous pouvez rediriger l'utilisateur vers la page de connexion, par exemple.
    header("Location: login.php");
    exit();
}
