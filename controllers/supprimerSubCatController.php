<?php
include('./model/sub_categorie.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (isset($id)) {
    $subcategorie = SubCategorie::getSubCategorieById($id);
    $subcategorie->SupprimersubCategorie($id);
    if ($subcategorie) {
        header("Location: sous-categories");
        exit;
    }
}
