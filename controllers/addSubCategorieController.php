<?php
include './model/sub_categorie.php';
include './model/categorie.php';
$id_categorie = filter_input(INPUT_POST, "id_categorie", FILTER_VALIDATE_INT);
$nom_subcategorie = filter_input(INPUT_POST, "nom_subcategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$slug_subcategorie = filter_input(INPUT_POST, "slug_subcategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categories = Categorie::getAll();

if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    if(isset($_POST['ajouter'])) {
        $subcategorie= new SubCategorie();
        $subcategorie->setNomSubCategorie($nom_subcategorie);
        $subcategorie->setSlug_subcategorie($slug_subcategorie);
        $subcategorie->setId_categorie($id_categorie);
        $subcategorie->save();
          // Message de succès
          $message = "Sous-catégorie ajoutée avec succès.";
        }
        
        // Redirection vers la vue
        if (!empty($message)) {
            header('Location: sous-categories?message=' . urlencode($message));
            exit();
        }
        
        // Inclusion du fichier de vue pour afficher le formulaire d'ajout de sous catégorie
        include "./views/admin/add-subcategorie.php";
    }
    
?>
