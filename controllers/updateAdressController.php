<?php
include('./model/users.php');
include "./model/categorie.php";

// Récupération des valeurs du formulaire
$id=filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ville = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$code_postale = filter_input(INPUT_POST, "code_postale", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categories = Categorie::getAll();
// Initialisation du message d'erreur
$error_message = "";
$users = Users::getUser($id);
if (isset($_POST['submit'])) {
    // Validation des champs
  
    if (!preg_match("/^.+$/", $adresse)) {
        $error_message = "L'adresse n'est pas valide";
    } elseif (empty($ville)) {
        $error_message = "La ville est manquante.";
    } elseif (empty($code_postale)) {
        $error_message = "Le code postal est manquant.";
    } elseif (!preg_match('/^\d{5}(-\d{4})?$/', $code_postale)) {
        $error_message = "Le code postal n'est pas valide.";
    }
   
    // Si aucune erreur n'est détectée, créez l'utilisateur
    if (empty($error_message)) {
        $users->setAdresse($adresse);
        $users->setVille($ville);
        $users->setCode_postale($code_postale);
        $users->updateAdress();
        // var_dump($users->updateAdress());
    }
}

// La redirection vers la page inscription avec l'éventuel message d'erreur
include "./views/update-adress.php";