<?php
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
                                        <input type="checkbox" class="marque-checkbox" data-marqueid="<?= $marque['id']; ?>">
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
        <div class="col-md-9">
            <?php if (isset($error_message)) : ?>
                <div class="col-md-12 text-center">
                    <p class="text-success text-lg fw-bold"><i class="bi bi-check-all"></i> <?= $error_message ?></p>
                </div>
            <?php endif; ?>
            <?php if (isset($resultats)) : ?>
                <div class="row">
                    <?php $filtersActive = false; // Variable pour suivre si des filtres sont actifs 
                    ?>
                    <?php foreach ($resultats as $produit) : ?>
                        <?php
                        // Vérifiez si le produit est épuisé en utilisant la méthode isOutOfStock() du modèle.
                        $isOutOfStock = $produit->isOutOfStock();
                        ?>
                        <div class="col-md-4 product <?php echo $isOutOfStock ? 'out-of-stock' : ''; ?>" data-marqueid="<?= $produit->getId_marque() ?>" data-prix="<?= $produit->getPrix(); ?>">
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
                        <?php foreach ($resultats as $produit) : ?>
                            <div class="col-md-4 product" data-marqueid="<?= $produit->getId_marque() ?>" data-prix="<?= $produit->getPrix(); ?>">
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
                <p class="text-center fw-bold">Aucun produit dans cette recherche.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<script>
    const prixMaxInput = document.getElementById("prixMax");
    const prixMaxValue = document.getElementById("prixMaxValue");
    const marqueCheckboxes = document.querySelectorAll(".marque-checkbox");


    // Mettre à jour la valeur affichée du prix maximum lorsque l'utilisateur déplace le curseur
    prixMaxInput.addEventListener("input", () => {
        prixMaxValue.textContent = prixMaxInput.value + " €";
        filtrerProduits(); // Appelez la fonction pour filtrer les produits
    });
    // Écouteur d'événement pour les cases à cocher de sous-catégories
    marqueCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", filterProducts);
    });

    // Fonction pour filtrer les produits en fonction du prix maximum et des sous-catégories sélectionnées
    function filtrerProduits() {
        const prixMax = parseFloat(prixMaxInput.value);
        const selectedMarques = Array.from(marqueCheckboxes)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.getAttribute("data-marqueid"));

        // Sélectionnez tous les éléments de classe "product"
        const produits = document.querySelectorAll(".product");

        produits.forEach(produit => {
            const prixProduit = parseFloat(produit.getAttribute("data-prix"));
            const productMarque = produit.getAttribute("data-marqueid");
            const displayStyle = prixProduit <= prixMax && (selectedMarques.length === 0 || selectedMarques.includes(productMarque)) ? "block" : "none";
            produit.style.display = displayStyle;
        });
    }



    // Fonction pour filtrer les produits en fonction des cases à cocher de sous-catégories
    function filterProducts() {
        filtrerProduits(); // Appelez la fonction de filtrage principale
    }

    // Appelez la fonction de filtrage au chargement de la page
    filtrerProduits();
    const toggleFiltersButton = document.getElementById("toggleFilters");
    // Sélectionnez la div des filtres par son ID
    const filtersDiv = document.getElementById("filters");
    toggleFiltersButton.addEventListener("click", function() {
        // Si les filtres sont actuellement visibles, masquez-les ; sinon, affichez-les
        if (filtersDiv.style.display === "block") {
            filtersDiv.style.display = "none";
        } else {
            filtersDiv.style.display = "block";
        }
    });
</script>
<?php
include "./views/includes/footer.php";
?>
</body>
</html>