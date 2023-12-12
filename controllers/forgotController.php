<?php
require('./model/users.php');
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$email = "siham140kamil@gmail.com";
$password = filter_input(INPUT_POST, "password");
if ($email && $password) {
    $users = new Users;
    $users->setEmail($email);
    $users->setPassword($hex);
    $users->save();
}
$bytes = openssl_random_pseudo_bytes(12);
$hex   = bin2hex($bytes);
$tab = [$email, $hex];
$p = json_encode($tab);
$p = bin2hex($p);

echo "<br>";
//var_dump($hex);
include "mails.php";
$server = $_SERVER['SERVER_NAME'];
$chaine = "<a href='http://$server/validationPass?p=$p'>toto</a>";
envoyerMail("siham140kamil@gmail.com", "init mot de passe", $chaine, $email);

$lien = bin2hex(json_encode($tab));


/* include "../views/validationPass.php"; */
