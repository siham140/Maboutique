<?php
include('./model/produit.php');
include('./model/sub_categorie.php');
include('./model/categorie.php');
include('./model/marque.php');
$nom_produit = filter_input(INPUT_POST, "nom_produit", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$slug = filter_input(INPUT_POST, "slug", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$prix = filter_input(INPUT_POST, "prix", FILTER_VALIDATE_FLOAT);
$stock = filter_input(INPUT_POST, "stock", FILTER_VALIDATE_INT);
$description_produit = filter_input(INPUT_POST, "description_produit", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id_subcategorie = filter_input(INPUT_POST, "id_subcategorie", FILTER_VALIDATE_INT);
$id_categorie = filter_input(INPUT_POST, "id_categorie", FILTER_VALIDATE_INT);
$remise = filter_input(INPUT_POST, "remise", FILTER_VALIDATE_INT);
$dateEntree = filter_input(INPUT_POST, "date");
$id_marque = filter_input(INPUT_POST, "id_marque", FILTER_VALIDATE_INT);

$dateEntree = date("Y-m-d", strtotime(str_replace('/', '-', $dateEntree)));

if (isset($_FILES["image_produit"])) {
    $targetDir = "./public/upload/images/";
    $targetFile = $targetDir . basename($_FILES["image_produit"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Vérification si le fichier est une image réelle
    $check = getimagesize($_FILES["image_produit"]["tmp_name"]);
    if ($check === false) {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Limiter la taille du fichier
    if ($_FILES["image_produit"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser uniquement certains formats de fichier
    $allowedFormats = array("jpg", "jpeg", "png", "gif", "webp", "avif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    if ($uploadOk === 1) {
        // Renommer le fichier pour éviter les collisions
        $newFileName = uniqid() . '.' . $imageFileType;
        $newFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES["image_produit"]["tmp_name"], $newFilePath)) {
            echo "Le fichier a été téléchargé et renommé avec succès.";
            // $newFileName comme valeur de l'image_produit
            $image_produit = $newFileName;
        } else {
            echo "Une erreur est survenue lors du téléchargement du fichier.";
        }
    }
}

if ($_SESSION["role"] != "admin") {
    header('location:./views/404.html');
    
} else {
    $subcategories = SubCategorie::getAll();
    $categories = Categorie::getAll();
    $marques = Marque::getAll();
    if (isset($_POST['ajouter'])) {
        $produit = new Produit();
        $produit->setNom_produit($nom_produit);
        $produit->setSlug($slug);
        $produit->setDescription_produit($description_produit);
        $produit->setPrix($prix);
        $produit->setImage_produit($image_produit);
        $produit->setId_categorie($id_categorie);
        $produit->setId_subcategorie($id_subcategorie);
        $produit->setStock($stock);
        $produit->setRemise($remise);
        $produit->setDateEntree($dateEntree);
        $produit->setId_marque($id_marque);
        $result = $produit->save();
             // Message de succès
             $message = "Produit ajouté avec succès.";
            }
            
            // Redirection vers la vue "afficher-produit" (après l'ajout réussi)
            if (!empty($message)) {
                header('Location: afficher_produit?message=' . urlencode($message));
                exit();
            }
            
            // Inclusion du fichier de vue pour afficher le formulaire d'ajout de produit
            include "./views/admin/add-produit.php";
        }
  
