<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main>
    <section class="container mt-4">
        <div class="text-center bs-success-bg-subtle">
            <h2>Votre panier :</h2>
        </div>
        <?php
        $total = 0;
        foreach ($_SESSION["validation_panier"] as $item) :
            $total += $item['totalProduit'];
        ?>
            <div class="d-flex justify-content-center mt-3">
                <div>
                    <img src="./images/<?php echo $item['imageProduit']; ?>" alt="image"/>
                </div>
                <div class="card-text mt-4">
                    <h4><?php echo $item['nomProduit']; ?></h4>
                    <h4 class="text-success"><?php echo $item['prix']; ?><i class="bi bi-currency-euro"></i></h4>
                    <h4>Quantité: <?php echo $item['quantite']; ?></h4>
                </div>
            </div>
        <?php endforeach; ?>
        <h4 class="text-center fw-bold py-2">Total de votre panier: <?php echo $total; ?><i class="bi bi-currency-euro"></i></h4>
        <!-- <form method="post" action="checkout_livraison" class="col-6 mx-auto my-auto">
    <input type="submit" name="livraison" value="Passer à l'étape de livraison" class="btn btn-warning p-2 text-center">
</form> -->
<div class="text-center">
<a href="checkout_livraison" class="btn btn-warning py-2">Passer à l'étape de livraison</a>
</div>

    </section>
</main>
    <?php
include "./views/includes/footer.php";
?>
</body>
</html>
