<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main class="w-100">
    <?php if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) : ?>
        <div class="d-flex flex-column justify-content-center align-items-center text-center mt-4">
            <p class="fw-bold">Votre panier est vide</p>
            <span class="">Connectez-vous pour consulter votre panier.</span><br>
            <p><a href="connexion" class="btn btn-warning px-4 btn-lg">Me connecter</a></p>
            <p><a href="/" class="text-dark">Continuer mes achats</a></p>
        </div>
    <?php else : ?>
        <?php
        $total = 0;
        $subTotal = 0;
        foreach ($panier as $item) :
            $quantite = $_SESSION['panier'][$item['id']];
            $total = $quantite * $item['prix'];
            $prixTotal = $item['prix'] * (1 - ($item['remise'] / 100));
            $subtotal_item = $quantite * $prixTotal;
            $total += $subtotal_item;
        ?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="marge-droite">
                    <img src="./images/<?= $item['image_produit'] ?>" alt="image" />
                </div>
                <section class="product">
                    <p class="nom-produit"><?php echo $item['nom_produit'] ?></p>
                    <div class="panier-qt-prix">
                        <form method="post" class="p-0">
                            <input type="hidden" name="action" value="retirer">
                            <input type="hidden" name="id_produit" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="decrease">-</button>
                        </form>
                        <span class="quantite p-2"><?php echo $quantite; ?></span>
                        <form method="post" class="p-0">
                            <input type="hidden" name="action" value="ajouter">
                            <input type="hidden" name="id_produit" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="increase">+</button>
                        </form>
                        <a href="supprimer_produit_panier?id=<?php echo $item['id'] ?>" class="link-danger ml-3" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                        <?php if ($item['remise'] > 0) : ?>
                            <span class="prix"><?php echo $prixTotal; ?><i class="fa fa-solid fa-euro"></i></span>
                        <?php else : ?>
                            <span class="prix"><?php echo $item['prix']; ?><i class="fa fa-solid fa-euro"></i></span>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
            <!-- <h3 class="total text-white">Total: <?php echo $subtotal_item; ?> <i class="fa fa-solid fa-euro"></i></h3> -->
            <?php $subTotal += $subtotal_item; ?>
            </div>
        <?php endforeach; ?>
        <div class="chekout">
            <div class="total-recap">
                <h4 colspan="7"><strong>Sous total:</strong>
                </h4>
                <h4 class="totalAmount"><b><?php echo $subTotal; ?> <i class="fa fa-solid fa-euro"></b></i>
                </h4>
            </div>
            <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"]) : ?>
                <div colspan="8" class="mx-auto my-auto">

                    <form method="post" action="valider_panier" class="p-0 mt-3">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <input type="submit" class="btn btn-warning" name="valider" value="Valider la panier">
                        <!-- <input type="submit" class="btn btn-danger" name="vider" value="Vider le panier" onclick="return confirm('Êtes-vous sûr de vouloir vider le panier ?')"> -->
                    </form>
                </div>
            <?php else : ?>

                <a href="validation-panier" class="btn btn-warning">Valider la panier</a>
        </div>
    <?php endif; ?>
    </div>
<?php endif; ?>
</main>
<?php
include "./views/includes/footer.php"
?>