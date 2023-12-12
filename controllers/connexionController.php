<?php
include "./model/users.php";
include "./model/categorie.php";

 // Récupération de la liste des catégories
 $categories = Categorie::getAll();

// Nettoyage et validation des données du formulaire
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Vérifiez si l'utilisateur est bloqué en raison de plusieurs tentatives
if (isset($_SESSION['blocked_until']) && $_SESSION['blocked_until'] > time()) {
    $remainingTime = $_SESSION['blocked_until'] - time();
    $error_message = "Trop de tentatives de connexion. Réessayez dans " . $remainingTime . " secondes.";
} else {
    // Générez et stockez le jeton CSRF dans la session
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];

    if (isset($_POST['submit'])) {
        // Assurez-vous que le jeton CSRF est valide
        if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
            // Authentification de l'utilisateur
            $user = Users::connexion($email, $password);
            if ($user && password_verify($password, $user['password'])) {

                // Réinitialisez le compteur de tentatives
                unset($_SESSION['login_attempts']);

                // Authentification réussie, stockez les informations dans la session
                $_SESSION["logged"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $user['id'];
                $_SESSION["prenom"] = $user['prenom'];
                $_SESSION["panier"] = $user['panier'];
                $_SESSION["nom"] = $user['nom'];
                $_SESSION["adresse"] = $user['adresse'];
                $_SESSION["ville"] = $user['ville'];
                $_SESSION["code_postale"] = $user['code_postale'];
                $_SESSION["role"] = $user['role'];

                if ($_SESSION["role"] === "admin") {
                    // Si l'utilisateur est un administrateur, redirigez vers la page d'administration
                    header('location:dashboard-admin');
                } else {
                    // Sinon, redirigez vers la page d'accueil
                    header('location:/');
                }
            } else {
                // Authentification échouée, affichez un message d'erreur

                // Incrémentation du compteur de tentatives de connexion
                if (!isset($_SESSION['login_attempts'])) {
                    $_SESSION['login_attempts'] = 1;
                } else {
                    $_SESSION['login_attempts']++;
                }

                // Si le seuil de tentatives est atteint, bloquez l'utilisateur pendant un certain temps
                if ($_SESSION['login_attempts'] >= 3) {
                    $blockTime = 300; // 5 minutes de blocage
                    $_SESSION['blocked_until'] = time() + $blockTime;
                    unset($_SESSION['login_attempts']);
                    $error_message = "Trop de tentatives de connexion. Réessayez dans " . $blockTime . " secondes.";
                
                } else {
                    $error_message = "Email ou mot de passe incorrect.";
                }
            }
        } else {
            // Le jeton CSRF n'est pas valide, traitez l'erreur
            $error_message = "Tentative d'attaque CSRF détectée.";
        }
    }
}

include("./views/connexion.php");
