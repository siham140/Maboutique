<?php
include('./model/marque.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (isset($id)) {
    $marque = marque::getmarqueById($id);
    $marque->SupprimerMarque($id);
    if ($marque) {
        header("Location: afficher_marque");
        exit;
    }
}