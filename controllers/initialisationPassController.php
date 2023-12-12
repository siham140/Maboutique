<?php
include('../model/users.php');
$password = filter_input(INPUT_POST, "password");
$password1 = filter_input(INPUT_POST, "password1");
if ($password) {
    $users = new Users();
    $users->setPassword($password);
    $users->setPassword($password1);
    $users->save();
}
include('../views/validationPass.php');
