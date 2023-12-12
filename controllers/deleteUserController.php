<?php
include('./model/users.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (isset($id)) {
    $user = new Users($id);
    $user->delete($id);
    header("location:afficher_user");
}


