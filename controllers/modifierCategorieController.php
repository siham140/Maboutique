<?php
include('./model/categorie.php');
$nom_categorie = filter_input(INPUT_POST, "nom_categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description_categorie = filter_input(INPUT_POST, "description_categorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    $categories = Categorie::getAll();
    $slug_categorie = filter_input(INPUT_GET, "p");
    $categorie = Categorie::getCategorieBySlug($slug_categorie);
    if (isset($_POST['Modifier'])) {
        $categorie->setNom_categorie($nom_categorie);
        $categorie->setDescription_categorie($description_categorie);
        $categorie->save();
    }
    include "./views/admin/modifier-categorie.php";
}
