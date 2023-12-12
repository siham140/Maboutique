<?php
include('./model/categorie.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (isset($id)) {
    $categorie = Categorie::getCategorieById($id);
    $categorie->SupprimerCategories($id);
    if ($categorie) {
        header("Location: categories");
        exit;
    }
}
