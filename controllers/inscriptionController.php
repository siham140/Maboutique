<?php
include('./model/users.php');
include "./model/categorie.php";

// Récupération des valeurs du formulaire
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$passwordConfirm = filter_input(INPUT_POST, "passwordConfirm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ville = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$code_postale = filter_input(INPUT_POST, "code_postale", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categories = Categorie::getAll();
$regex_prenom = "/^[A-Za-zéèêëàâäôöûüç\s'-]+$/";
$regex_nom = "/^[A-Za-zéèêëàâäôöûüç\s'-]+$/";
$regex_adresse = "/^[A-Za-z0-9éèêëàâäôöûüç\s'.,-]+$/";


// Initialisation du message d'erreur
$error_message = "";

if (isset($_POST['submit'])) {
    // Validation des champs
    if (!preg_match($regex_prenom, $prenom)) {
        $error_message = "Le prénom n'est pas valide.";
    } elseif (!preg_match($regex_nom, $nom)) {
        $error_message = "Le nom n'est pas valide.";
    } elseif (!preg_match($regex_adresse, $adresse)) {
        $error_message = "L'adresse n'est pas valide: " . $adresse;
    } elseif (empty($ville)) {
        $error_message = "La ville est manquante.";
    } elseif (empty($code_postale)) {
        $error_message = "Le code postal est manquant.";
    } elseif (!preg_match('/^\d{5}(-\d{4})?$/', $code_postale)) {
        $error_message = "Le code postal n'est pas valide.";
    } elseif (Users::getByEmail($email)) {
        $error_message = "L'adresse email existe déjà.";
    } elseif ($password !== $passwordConfirm) {
        $error_message = "Les mots de passe ne sont pas identiques.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $error_message = "Le mot de passe doit comporter au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.";
    }
    // Si aucune erreur n'est détectée, créez l'utilisateur
    if (empty($error_message)) {
        $users = new Users();
        $users->setPrenom($prenom);
        $users->setNom($nom);
        $users->setEmail($email);
        $users->setPassword($password);
        $users->setAdresse($adresse);
        $users->setVille($ville);
        $users->setCode_postale($code_postale);
        $users->save();
        header("location:connexion");
    }
}

// La redirection vers la page inscription avec l'éventuel message d'erreur
include "./views/inscription.php";
