<?php
require('../model/users.php');
$p = filter_input(INPUT_GET, "p");
$p = hex2bin($p);
$t = json_decode($p);


$email = $t[0];
$pass = $t[1];
/* 
$pass = hex2bin($pass); */

echo $email . "<br>" . $pass;
$user = Users::Connexion($email, $pass);
if ($user) {
    $newPass = filter_input(INPUT_POST, "password");
    if ($newPass) {
        $user = Users::getByEmail($email);
        // $newPass = password_hash($newPass, PASSWORD_DEFAULT);
        $user->setPassword($newPass);
        $user->save();
    }
    include "../views/validationPass.php";
} else {
    echo "erreur!!!!";
}
