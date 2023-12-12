<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Produits</h1>
  </div>
  <div class="ajout">
    <a href="add-produit" class="btn btn-warning">Ajouter</a>
  </div>
  <p><span class="promo">*</span> : Produit en promotion</p>

  <table id="datatable" class="display large responsive-table">
    <thead>
      <tr>
        <th class="text-center">Nom</th>
        <th class="text-center">Marque</th>
        <th class="text-center d-none d-md-table-cell">Image</th>
        <th class="text-center">Prix</th>
        <th class="text-center d-none d-md-table-cell">Remise</th>
        <th class="text-center d-none d-md-table-cell">Stock</th>

        <th class="text-center">Date</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($produits)) {

        foreach ($produits as $produit) {
          // Vérifier si le stock est égal à 0
          $isOutOfStock = $produit->getStock() == 0;
          // Vérifier si le produit est en promotion
          $isPromo = $produit->getRemise() > 0;
      ?>
          <tr <?php if ($isOutOfStock) echo 'style="background-color: red;"'; ?>>
            <td class="text-center">
              <?php if ($isPromo) echo '<span class="promo">*</span> '; ?>
              <?= $produit->getNom_produit(); ?>
            </td>
            <td class="text-center">
              <?php
              // le nom de la marque
              $nom_marque = '';
              foreach ($marques as $marque) {
                if ($marque->getId() == $produit->getId_marque()) {
                  $nom_marque = $marque->getNom_marque();
                }
              }
              echo $nom_marque;
              ?>
            </td>
            <td class="text-center d-none d-md-table-cell">
              <img src="../images/<?= $produit->getImage_produit(); ?>" class="t-images" alt="t-image">
            </td>
            <td class="text-center">
              <?= $produit->getPrix(); ?>€
            </td>
            <td class="text-center d-none d-md-table-cell">
              <?= $produit->getRemise() ?>
            </td>
            <td class="text-center d-none d-md-table-cell">
              <?= $produit->getStock() ?>
            </td>
            <td class="text-center">
              <?= $produit->getDateEntree() ?>
            </td>
            <td class="text-center">
              <a href="update-produit?s=<?= $produit->getSlug() ?>"><i class="bi bi-pencil-fill"></i></a>
              <a href="supprimer_produit?id=<?= $produit->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>

      <?php
        }
      }
      ?>
    </tbody>
  </table>
  </div>
 
  <?php include "./views/includes/footer_back.php"; ?>
  </body>

  </html>