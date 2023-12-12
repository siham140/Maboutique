<?php
// Inclusion du modèle de catégorie (où est définie la classe Categorie)
include('./model/categorie.php');

// Récupération et nettoyage des données postées depuis le formulaire
$nom_categorie = filter_input(INPUT_POST, "nom_categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description_categorie = filter_input(INPUT_POST, "description_categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Variable pour stocker le message de succès
$message = '';

// Vérification du rôle de l'utilisateur (doit être "admin" pour accéder)
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html'); // Redirection vers une page d'erreur 404 si le rôle n'est pas "admin"
} else {
    // Si l'utilisateur est un admin, on poursuit le traitement
    
    // Vérification si le formulaire a été soumis (lorsque le bouton "ajouter" est cliqué)
    if(isset($_POST['ajouter']))
    {
        // Création d'une nouvelle instance de la classe Categorie
        $categorie = new Categorie();
        
        // Définition des propriétés de la catégorie avec les données postées
        $categorie->setNom_categorie($nom_categorie);
        $categorie->setDescription_categorie($description_categorie);
        
        // Appel de la méthode "save" pour enregistrer la catégorie dans la base de données
        $categorie->save();
        
        // Message de succès
        $message = "Catégorie ajoutée avec succès.";
    }
    
    // Redirection vers la vue "afficher-categorie" (après l'ajout réussi)
    if (!empty($message)) {
        header('Location: categories?message=' . urlencode($message));
        exit();
    }
    
    // Inclusion du fichier de vue pour afficher le formulaire d'ajout de catégorie
    include "./views/admin/add-categorie.php";
}
?>

