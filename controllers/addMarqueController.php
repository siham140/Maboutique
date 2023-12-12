<?php
// Inclusion du modèle de catégorie (où est définie la classe marque)
include('./model/marque.php');

// Récupération et nettoyage des données postées depuis le formulaire
$nom_marque = filter_input(INPUT_POST, "nom_marque", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$slug = filter_input(INPUT_POST, "slug", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// Vérification du rôle de l'utilisateur (doit être "admin" pour accéder)
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html'); // Redirection vers une page d'erreur 404 si le rôle n'est pas "admin"
} else {
    // Si l'utilisateur est un admin, on poursuit le traitement
    
    // Vérification si le formulaire
    if(isset($_POST['ajouter']))
    {
        // Création d'une nouvelle instance de la classe marque
        $marque = new marque();
        $marque->setNom_marque($nom_marque);
        $marque->setSlug($slug);
        // Appel de la méthode "save" 
        $marque->save();
    }
    include "./views/admin/add-marque.php";
}
?>