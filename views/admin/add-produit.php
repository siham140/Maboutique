<?php include './views/includes/head_back.php' ?>
<title>Ajouter produit</title>
<?php
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ajouter une produit</h1>
    </div>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h4>Ajouter produit</h4>
                <form method="post" enctype="multipart/form-data">
                    <label class="form-label">Nom du produit:</label>
                    <input type="text" class="form-control" name="nom_produit">
                    <label class="form-label">slug:</label>
                    <input type="text" class="form-control" name="slug">
                    <label class="form-label">Image du produit:</label>
                    <input type="file" class="form-control" name="image_produit">
                    <label class="form-label">Prix:</label>
                    <input type="number" class="form-control" name="prix">
                    <label class="form-label">Remise:</label>
                    <input type="number" class="form-control" name="remise">
                    <input type="date" class="form-control" name="dateEntree" value="<?= date("Y-m-d") ?>">
                    <label for="id_categorie" class="mt-3">Categorie :</label>
                    <select name="id_categorie" id="id_categorie">
                        <option value="">Choisissez une catégorie</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie->getId() ?>"><?= $categorie->getNom_categorie() ?></option>

                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <label for="id_subcategorie" class="mt-3"> Sous categorie :</label>
                    <select name="id_subcategorie" id="id_subcategorie">
                        <option value="">Choisissez une sous catégorie</option>
                        <?php foreach ($subcategories as $subcategorie) : ?>
                            <option value="<?= $subcategorie->getId() ?>"><?= $subcategorie->getNomSubCategorie() ?></option>

                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <label class="form-label">Description:</label>
                    <textarea class="form-control" name="description_produit"></textarea>
                    <label class="form-label">Stock:</label>
                    <input type="number" class="form-control" name="stock">
                    <label for="id_marque" class="mt-3">Marque :</label>
                    <select name="id_marque" id="id_marque">
                        <option value="">Choisissez une marque</option>
                        <?php foreach ($marques as $marque) : ?>
                            <option value="<?= $marque->getId() ?>"><?= $marque->getNom_marque() ?></option>
                            </option>
                        <?php endforeach; ?>
                    </select><br>
                    <input type="submit" value="Ajouter produit" class="btn btn-primary my-2" name="ajouter">
                </form>
            </div>
        </div>
    </section>
    <?php
     include "./views/includes/footer_back.php";
    ?>
    </body>

    </html>