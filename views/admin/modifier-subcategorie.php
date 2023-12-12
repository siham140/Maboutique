<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modifier sous_catégorie</h1>
    </div>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h4>Modifier sous_catégorie</h4>
                <form method="post">
                    <label class="form-label">Nom de sous_categorie:</label>
                    <input type="text" class="form-control mb-4" name="nom_subcategorie" value="<?= $subcategorie ? $subcategorie->getNomSubCategorie() : ''; ?>">
                    <label class="form-label">Slug de sous_categorie:</label>
                    <input type="text" class="form-control mb-4" name="slug_subcategorie" value="<?= $subcategorie ? $subcategorie->getSlug_subCategorie() : ''; ?>">

                    <label for="id_categorie">Categorie :</label>
                    <select name="id_categorie" id="id_categorie">
                        <option value="">Choisissez une catégorie</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie->getId() ?>"><?= $categorie->getNom_categorie() ?></option>
                        <?php endforeach; ?>
                    </select><br>

                    <input type="submit" class="btn btn-primary my-2" name="modifier">
                </form>
            </div>
        </div>
    </section>
    <?php
    include "./views/includes/footer_back.php";
    ?>
    </body>

    </html>