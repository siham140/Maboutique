<?php
include "./model/users.php";
$prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ville = filter_input(INPUT_POST, "ville", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$code_postale = filter_input(INPUT_POST, "code_postale", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$id= filter_input(INPUT_GET, "i", FILTER_VALIDATE_INT);
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
} else {
    // $url = filter_input(INPUT_GET, "url");
    // $reps = explode("/", $url);
    // var_dump($reps);
    // $hashed_id = $reps[1];
    // $id = hex2bin($hashed_id);
    // var_dump($id);
   
$users = Users::getUser($id);
if (isset($_POST['submit'])) {
    $users->setPrenom($prenom);
    $users->setNom($nom);
    $users->setEmail($email);
    $users->setAdresse($adresse);
    $users->setVille($ville);
    $users->setCode_postale($code_postale);
    $users->save();
    var_dump($users->save());
    header("Location: afficher_user");
}

          
            
                // Message de succès
            //   $message = "utilisateur modifié avec succès.";
            // // Redirection vers la vue "afficher-produit" (après la modification réussie)
            // if (!empty($message)) {
            //     header("Location: afficher_user");
            //     exit();
            // }
            
            // Inclusion du fichier de vue pour afficher le formulaire d'ajout de produit
            include "./views/admin/modifier-user.php";
        }
