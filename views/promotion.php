<?php
$promotion=true;
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main class="container">
    <?php if (isset($produits)) : ?>
        <div class="row">
            <?php foreach ($produits as $produit) : ?>
                <div class="col-md-4 mx-auto"> <!-- Chaque carte de produit dans une colonne -->
                    <div class="card box-shadow mb-20 text-center">
                        <img class="mx-auto" src="./images/<?= $produit->getImage_produit(); ?>" alt="image" />
                        <p class="nom-produit"><?= $produit->getNom_produit(); ?></p>
                        <?php if ($produit->getRemise() > 0) : ?>
                            <div class="card__bottom">
                            <div class="prix-remise">
                               <span class="prix-barre"><?= $produit->getPrix(); ?>€</span>
                                <span class="text-danger">- <?= $produit->getRemise();?>%</span>
                            </div>
                            <span class="prix-produit"><?= ($produit->getPrix() * (1 - ($produit->getRemise() / 100))); ?>€</span>
                            </div>
                            
                        <?php else : ?>
                            <div class="card__bottom">
                            <span class="card__price-value prix-produit"><?= $produit->getPrix(); ?>€</span>
                            </div>
                        <?php endif; ?>
                        <div class="btn-detail">
                            <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-center fw-bold">Pas de produit en promotion en ce moment.</p>
    <?php endif; ?>
</main>

<?php
include "./views/includes/footer.php";
?>
</body>

</html>