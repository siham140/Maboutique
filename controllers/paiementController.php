<?php
include "./model/commandes.php";
include "./model/categorie.php";
$categories = Categorie::getAll();
include "./views/paiement.php";
        
