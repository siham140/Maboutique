<!doctype html>
<html lang="en">

<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main>
    <h4 class="text-center"><?= $produit->getNom_produit(); ?></h4>
    <section class="d-flex justify-content-center align-items-center">

        <article class="p-detail">
            <?php
            if (isset($produit)) :
            ?>
                <div class="product__sticky">

                    <div class="marge-droite">
                        <img src="./images/<?= $produit->getImage_produit(); ?>" alt="image" />
                    </div>
                </div>

                <section class="g-col-8 g-col-sm-12 g-col-md-5 g-start-xl-8">

                    <?php if ($produit->getRemise() > 0) : ?>
                        <div>
                            <h4 class="text-danger prix-barre"><?= $produit->getPrix(); ?>€</h4>
                            <h4 class="text-success"><?= ($produit->getPrix() * (1 - ($produit->getRemise() / 100))); ?>€</h4>
                        </div>
                    <?php else : ?>
                        <h4 class="text-success"><?= $produit->getPrix(); ?>€</h4>
                    <?php endif; ?>
                    <?php
                    // Récupérer la description du produit depuis la base de données et la ligner
                    $descriptionProduit = $produit->getDescription_produit();
                    $descriptionAvecRetoursALaLigne = nl2br($descriptionProduit);
                    ?>
                    <p><?= $descriptionAvecRetoursALaLigne ?></p>
                    <?php if ($produit->getStock() > 0) : ?>
                        <p class="text-success text-lg fw-bold"><i class="bi bi-check-lg"></i> Disponible</p>
                    <?php else : ?>
                        <p class="text-danger text-lg fw-bold"><i class="bi bi-x-lg"></i> Epuisé</p>
                    <?php endif; ?>
                    <form method="post" class="p-0" id="monFormulaire">
                        <input type="hidden" name="id_produit" value="<?= $produit->getId() ?>" />
                        <input type="hidden" name="nom_produit" value="<?= $produit->getNom_produit(); ?>" />
                        <input type="hidden" name="prix" value="<?= $produit->getPrix(); ?>" />
                        <input type="submit" name="submit" class="btn btn-warning" value="Ajouter au panier">
                    </form>

                </section>
            <?php
            endif;
            ?>
        </article>
    </section>
    <?php if (isset($message)) : ?>
        
            <?php echo $message; ?>
       
    <?php endif; ?>
</main>
<script>
   const viewCartButton = document.getElementById("view-cart-button");
const continueShoppingButton = document.getElementById("continue-shopping-button");
const messageContainer = document.getElementById('message-container');
const fermer = document.getElementById('fermer');

 // Reste du code pour gérer le bouton Voir le panier et Continuer vos achats.
fermer.addEventListener("click", () => {
        // Redirigez l'utilisateur vers la page du panier
        messageContainer.remove();
    });
    // Reste du code pour gérer le bouton Voir le panier et Continuer vos achats.
    viewCartButton.addEventListener("click", () => {
        // Redirigez l'utilisateur vers la page du panier
        window.location.replace("panier");
    });
    continueShoppingButton.addEventListener("click", () => {
        // Réalisez l'action pour continuer vos achats (par exemple, redirigez l'utilisateur vers la page de produits)
        window.location.replace("nouveaute");
    });
</script>
</body>
<?php
include "./views/includes/footer.php";
?>
</body>

</html>