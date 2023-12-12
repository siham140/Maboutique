<?php
include "./model/categorie.php";
include "./model/panier.php";
$categories=Categorie::getAll();
include("./views/check_panier.php");  



