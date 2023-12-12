<?php
include "./model/users.php";
// Nettoyez et validez les données du formulaire
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, "password");
// Générez et stockez le jeton CSRF dans la session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

if (isset($_POST['submit'])) {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $user = Users::connexion($email, $password);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["logged-admin"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["prenom"] = $user['prenom'];
            $_SESSION["role"] = $user['role'];
                // Vérification d'autorisation supplémentaire
                if ($_SESSION["role"] === "admin") {
                    header('location:dashboard-admin');
                } else {
                    // L'utilisateur n'est pas autorisé à accéder au tableau de bord
                    $error_message = "Vous n'avez pas l'autorisation d'accéder au tableau de bord.";
                }
            } else {
                // Authentification échouée, affichez un message d'erreur
                $error_message = "Email ou mot de passe incorrect.";
            }
        } else {
            // Le jeton CSRF n'est pas valide, traitez l'erreur
            $error_message = "Tentative d'attaque CSRF détectée.";
        }
    }
include "./views/admin/authentification-admin.php";