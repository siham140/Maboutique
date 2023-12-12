<?php
include "./model/users.php";
// Vérification d'autorisation supplémentaire
if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
}
else{
include "./views/admin/dashboard.php";
}