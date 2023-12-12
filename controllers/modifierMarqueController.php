<?php
include('./model/marque.php');
$nom_marque = filter_input(INPUT_POST, "nom_marque", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    $marques = marque::getAll();
    $slug = filter_input(INPUT_GET, "p");
    $marque = marque::getMarqueSlug($slug);
    if (isset($_POST['Modifier'])) {
        $marque->setNom_marque($nom_marque);
        $marque->save();
    }
    include "./views/admin/modifier-marque.php";
}
