<?php
include "./model/users.php";
include "./model/categorie.php";
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$nom = filter_input(INPUT_POST, "nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$adresse = filter_input(INPUT_POST, "adresse",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ville = filter_input(INPUT_POST, "ville",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$code_postale = filter_input(INPUT_POST, "code_postale",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$categories=Categorie::getAll();
if (isset($_POST['submit'])) {
    $user = Users::connexion($email,$password);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["logged"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $user['id'];
        $_SESSION['validation_panier'] = $user['panier'];
        $_SESSION["prenom"] = $user['prenom'];
        $_SESSION["nom"] = $user['nom'];
        $_SESSION["adresse"] = $user['adresse'];
        $_SESSION["ville"] = $user['ville']; 
        $_SESSION["code_postale"] = $user['code_postale'];
        $_SESSION["role"] = $user['role'];
        header('location:panier');
    } else {
        // Authentification échouée, affichez un message d'erreur
        $error_message = "Email ou mot de passe incorrect.";
    }
}
include "./views/validation-panier.php";