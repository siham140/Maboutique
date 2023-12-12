<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Sous-catégories</h1>
  </div>
  <div class="ajout">
    <a href="add-subcategorie" class="btn btn-warning">Ajouter</a>
  </div>

  <table id="datatable" class="display">
    <thead>
      <tr>
        <th class="text-center">Nom</th>
        <th class="text-center">Slug</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if (!empty($sousCategries)) {

        foreach ($sousCategries as $sousCategrie) {
      ?>
          <tr>
            <td class="text-center"><?= $sousCategrie->getNomSubCategorie(); ?>
            <td class="text-center">
              <?= $sousCategrie->getSlug_subcategorie();?>
            </td>
            <td class="text-center"><a href="update-subcategorie?p=<?= $sousCategrie->getSlug_subcategorie() ?>">
                <i class="bi bi-pencil-fill"></i></a> <a href="supprimer-subcategories?id=<?= $sousCategrie->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"><i class="bi bi-trash"></i></a></td>
          </tr>
      <?php
        }
      } ?>
    </tbody>
  </table>
  
  <?php include "./views/includes/footer_back.php"; ?>
  </body>

  </html>