<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Marques</h1>
  </div>
  <div class="ajout">
    <a href="add-marque" class="btn btn-warning">Ajouter</a>
  </div>

  <table id="datatable" class="display">
    <thead>
      <tr>
        <th class="text-center">Nom de la marque</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if (!empty($marques)) {

        foreach ($marques as $marque) {
      ?>
          <tr>
            <td class="text-center"><?= $marque->getNom_marque(); ?>
            <td class="text-center"><a href="update-marque?p=<?= $marque->getSlug() ?>">
                <i class="bi bi-pencil-fill"></i></a> <a href="supprimer_marque?id=<?= $marque->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette marque ?')"><i class="bi bi-trash"></i></a></td>
          </tr>
      <?php
        }
      } ?>
    </tbody>
  </table>
  
  <?php include "./views/includes/footer_back.php"; ?>
  </body>

  </html>