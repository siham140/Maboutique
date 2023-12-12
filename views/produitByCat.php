<?php
$produitByCat=true;
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main class="container">
    <div class="row">
        <!-- Colonne de la sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <h4 id="toggleFilters"><img class="image-filtre" src="./images/filtres.png" alt="image" />Filtres</h4>
                <div id="filters">
                    <h3>Prix</h3>
                    <input type="range" id="prixMax" min="0" max="2000" step="10" value="2000">
                    <span id="prixMaxValue">2000 €</span>
                    <h3>Marque</h3>
                    <ul>
                        <?php if (isset($marques)) : ?>

                            <?php foreach ($marques as $marque) : ?>
                                <li>
                                    <label>
                                        <input type="checkbox" class="marque-checkbox" data-marqueid="<?= $marque['id_marque']; ?>">
                                        <?= $marque['nom_marque']; ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Colonne du contenu principal -->
        <section class="col-md-9">
            <?php if (isset($error_message)) : ?>
                <div class="col-md-12 text-center">
                    <p class="text-success text-lg fw-bold"><i class="bi bi-check-all"></i> <?= $error_message ?></p>
                </div>
            <?php endif; ?>
            <?php if (isset($resultats) && empty($resultats)) : ?>
                <p class="text-center f-w-bold">Aucun produit ne correspond à cette recherche.</p>
            <?php elseif (isset($resultats) && !empty($resultats)) : ?>
                <div class="row">
                    <?php foreach ($resultats as $produit) : ?>
                        <div class="col-md-4 mb-5">
                            <div class="card box-shadow text-center">
                            <img class="mx-auto" src="./images/<?= $produit->getImage_produit(); ?>" alt="image"/>
                                <p class="nom-produit"><?= $produit->getNom_produit(); ?></p>
                                <span class="prix-produit"><?= $produit->getPrix(); ?>€</span>
                                <div class="btn-detail">
                                    <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                    </section>
    <?php endif; ?>
    <?php if (isset($produit) && empty($produit)) : ?>
        <p class="text-center f-w-bold">Aucun produit dans cette catégorie.</p>
    <?php elseif (isset($produits) && !empty($produits)) : ?>
        <div class="row">
            <?php $filtersActive = false; // Variable pour suivre si des filtres sont actifs 
            ?>
            <?php foreach ($produits as $produit) : ?>
                <?php
                // on verifie si le produit est épuisé en utilisant la méthode isOutOfStock() du modèle.
                $isOutOfStock = $produit->isOutOfStock();
                ?>
                <div class="col-md-4 product <?php echo $isOutOfStock ? 'out-of-stock' : ''; ?>" data-marqueid="<?= $produit->getId_marque() ?>" data-prix="<?= $produit->getPrix(); ?>">
                    <div class="card box-shadow mb-20 text-center">
                    <img class="mx-auto" src="./images/<?= $produit->getImage_produit(); ?>" alt="image"/>
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
                        <?php if ($isOutOfStock) : ?>
                            <p class="text-danger">Épuisé</p>
                        <?php else : ?>
                            <div class="btn-detail">
                                <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $filtersActive = true; ?>
            <?php endforeach; ?>

            <?php if (!$filtersActive) : // Si aucun filtre n'est actif, afficher tous les produits 
            ?>
                <?php foreach ($produits as $produit) : ?>
                    <div class="col-md-4 product" data-marqueid="<?= $produit->getId_marque() ?>" data-prix="<?= $produit->getPrix(); ?>">
                        <div class="card box-shadow text-center">
                           <p class="nom-produit"><?= $produit->getNom_produit(); ?></p>
                            <h2></h2>
                            <span class="text-success prix-produit"><?= $produit->getPrix(); ?>€</span>
                            <div class="btn-detail">
                                <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>
    </div>
</main>
<?php
include "./views/includes/footer.php";
?>
</body>
</html>