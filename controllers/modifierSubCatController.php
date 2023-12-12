<?php
include './model/sub_categorie.php';
include './model/categorie.php';
$id_categorie = filter_input(INPUT_POST, "id_categorie", FILTER_VALIDATE_INT);
$nom_subcategorie = filter_input(INPUT_POST, "nom_subcategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$categories = Categorie::getAll();

if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    $slug_subcategorie = filter_input(INPUT_GET, "p", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subcategorie=SubCategorie::getBySlugSubcategorie($slug_subcategorie);
    var_dump($subcategorie);
    if (isset($_POST['Modifier'])) {
        $subcategorie->setNomSubCategorie($nom_subcategorie);
        $subcategorie->setSlug_subcategorie($slug_subcategorie);
        $subcategorie->setId_categorie($id_categorie);
        $subcategorie->save();
    }

    include "./views/admin/modifier-subcategorie.php";
}
