<?php
$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
// Supprimez le produit du panier en le recherchant dans la session
if (isset($_SESSION['panier']) && isset($_SESSION['panier'][$id])) {
    unset($_SESSION['panier'][$id]);
}
header('location:panier');
