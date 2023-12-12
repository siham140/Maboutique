<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>

<main>
    <section class="container mt-4">
        <div class="text-center bs-success-bg-subtle">
            <h2 class="text-success">Merci pour votre commande ! </h2>
            <p>Voici un récapitulatif :</p>
        </div>

        <?php
        $total = 0;
        // Récupérez le numéro de commande de la session
        if (isset($_SESSION['numero_commande'])) {
            // Le numéro de commande existe, affichez-le une seule fois.
            $numeroCommande = $_SESSION['numero_commande'];
        } else {
            // Gérez le cas où le numéro de commande n'est pas disponible.
            $numeroCommande = null;
            exit('Le numéro de commande n\'est pas disponible.');
        }
        ?>
        <h3 class="text-center">Commande n° <?= $numeroCommande ?></h3>
        <?php
        foreach ($_SESSION["validation_panier"] as $item) :
            $total += $item['totalProduit'];
        ?>
            <!-- Affichez les détails de chaque produit dans le panier ici -->
            <div class="d-flex justify-content-center mt-3">
                <div>
                    <img src="./images/<?php echo $item['imageProduit']; ?>" alt="Image du produit">
                </div>
                <div class="card-text mt-4">
                    <h4><?php echo $item['nomProduit']; ?></h4>
                    <h4 class="text-success"><?php echo $item['prix']; ?><i class="bi bi-currency-euro"></i></h4>
                    <h4>Quantité: <?php echo $item['quantite']; ?></h4>
                </div>
            </div>
        <?php endforeach; ?>
        <h4 class="text-center fw-bold py-2">Total de la commande: <?php echo $total; ?><i class="bi bi-currency-euro"></i></h4>

        <div class="text-center mb-3">
            <p>Merci encore pour votre commande !</p>
            <p><a href="/" class="text-dark"><i class="bi bi-arrow-counterclockwise"></i> Retour à la page d'accueil</a></p>
        </div>
    </section>
</main>

<?php
include "./views/includes/footer.php";
?>
</body>
</html>