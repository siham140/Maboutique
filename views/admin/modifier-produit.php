<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modifier le produit</h1>
    </div>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <form method="post" enctype="multipart/form-data">
                    <label class="form-label">Nom du produit:</label>
                    <input type="text" class="form-control" name="nom_produit" value="<?= $produit->getNom_produit(); ?>">
                    <label class="form-label">slug:</label>
                    <input type="text" class="form-control" name="slug" value="<?= $produit->getSlug(); ?>">
                    <label class="form-label">Image du produit:</label>
                    <img src="./images/<?= $produit->getImage_produit(); ?>" alt="Image actuelle du produit" width="100">
                    <input type="file" class="form-control" name="image_produit">
                    <label class="form-label">Prix:</label>
                    <input type="number" class="form-control" name="prix" value="<?= $produit->getPrix(); ?>"€>
                    <label class="form-label">Remise:</label>
                    <input type="number" class="form-control" name="remise" value="<?= $produit->getRemise(); ?>"><br>
                    <label class="form-label">Date:</label>
                    <input type="date" class="form-control" name="dateEntree" value="<?php echo date('Y-m-d'); ?>"><br>

                    <label for="id_categorie">Categorie :</label>
                    <select name="id_categorie" id="id_categorie">
                        <?php foreach ($categories as $categorie) : ?>
                            <?php echo "<option value='" . $categorie->getId() . "'>" . $categorie->getNom_categorie() . "</option>"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <label for="id_subcategorie" class="mt-3"> Sous categorie :</label>
                    <select name="id_subcategorie" id="id_subcategorie">
                        <?php foreach ($subcategories as $subcategorie) : ?>
                            <option value="<?= $subcategorie->getId() ?>"><?= $subcategorie->getNomSubCategorie() ?></option>

                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" name="description_produit" value="<?= $produit->getDescription_produit(); ?>">
                    <label class="form-label">Stock:</label>
                    <input type="number" class="form-control" name="stock" value="<?= $produit->getStock(); ?>">
                    <label for="id_marque" class="mt-3">Marque :</label>
                    <select name="id_marque" id="id_marque">
                        <?php foreach ($marques as $marque) : ?>
                            <option value="<?= $marque->getId() ?>"><?= $marque->getNom_marque() ?></option>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <input type="submit" value="Modifier produit" class="btn btn-primary my-2" name="modifier">

                </form>

            </div>
        </div>
    </section>
    <?php include "./views/includes/footer_back.php"; ?>
    </body>

    </html>