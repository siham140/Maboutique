<main class="container">
    <div class="row">
        <!-- Colonne de la sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <h4 id="toggleFilters"><img class="image-filtre" src="./images/filtres.png" alt="image"/>Filtres</h4>
                <div id="filters">
                    <h4>Prix</h4>
                    <input type="range" id="prixMax" min="0" max="4000" step="10" value="4000">
                    <span id="prixMaxValue">4000 €</span>

                    <h4>Marque</h4>
                    <ul>
                        <?php if (isset($subcategories)) : ?>
                            <?php foreach ($subcategories as $subcategorie) : ?>
                                <li>
                                    <label>
                                        <input type="checkbox" class="subcategory-checkbox" data-subcatid="<?= $subcategorie->getId(); ?>">
                                        <?= $subcategorie->getNomSubCategorie() ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Colonne du contenu principal -->
        <div class="col-md-9">
            <?php if (isset($produits)) : ?>
                <div class="row">
                    <?php $filtersActive = false; // Variable pour suivre si des filtres sont actifs 
                    ?>
                    <?php foreach ($produits as $produit) : ?>
                        <div class="col-md-4 product" data-subcatid="<?= $produit->getId_subcategorie() ?>" data-prix="<?= $produit->getPrix(); ?>">
                            <div class="card box-shadow mb-20 text-center">
                                <a href="detail?s=<?= $produit->getSlug() ?>"><img src="./images/<?= $produit->getImage_produit(); ?>" alt="image" class="img-thumbnail mb-3" style="border: none" /></a>
                                <h2><a href="detail?s=<?= $produit->getSlug() ?>" style="text-decoration: none; color: black;"><?= $produit->getNom_produit(); ?></a></h2>
                                <?php if ($produit->getRemise() > 0) : ?>
                                    <div class="prix-remise">
                                        <h4 class="text-danger prix-barre"><?= $produit->getPrix(); ?>€</h4>
                                        <h4 class="text-success"><?= ($produit->getPrix() * (1 - ($produit->getRemise() / 100))); ?>€</h4>
                                    </div>
                                <?php else : ?>
                                    <h4 class="text-success"><?= $produit->getPrix(); ?>€</h4>
                                <?php endif; ?>

                                <?php if ($produit->getRemise() > 0) : ?>
                                    <span class="round-badge">- <?= $produit->getRemise();  ?> %</span>
                                <?php endif; ?>
                                <div class="btn-detail">
                                    <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                                </div>

                            </div>
                        </div>
                        <?php $filtersActive = true; ?>
                    <?php endforeach; ?>

                    <?php if (!$filtersActive) : // Si aucun filtre n'est actif, afficher tous les produits 
                    ?>
                        <?php foreach ($produits as $produit) : ?>
                            <div class="col-md-4 product" data-subcatid="<?= $produit->getId_subcategorie() ?>" data-prix="<?= $produit->getPrix(); ?>">
                                <div class="card box-shadow text-center">
                                    <a href="detail?s=<?= $produit->getSlug() ?>"><img src="./images/<?= $produit->getImage_produit(); ?>" alt="image" class="img-thumbnail mb-3" style="border: none" /></a>
                                    <h2><a href="detail?s=<?= $produit->getSlug() ?>" style="text-decoration: none; color: black;"><?= $produit->getNom_produit(); ?></a></h2>
                                    <h4 class="text-success"><?= $produit->getPrix(); ?>€</h4>
                                    <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <p class="text-center fw-bold">Aucun produit dans cette catégorie.</p>
            <?php endif; ?>
        </div>
    </div>
</main>