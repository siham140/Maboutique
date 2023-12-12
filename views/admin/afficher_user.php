<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Utilisateurs</h1>
      </div>
    <table id="datatable" class="display">
    <thead>
        <tr>
            <th class="text-center">Nom</th>
            <th class="text-center">Adresse</th>
            <th class="text-center">Email</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php

if (isset($users)) {

    foreach ($users as $user) {
?>
        <tr>
            <td class="text-center td-user"><?= $user->getNom()?><?= $user->getPrenom()?></td>
            <td class="text-center td-user"><?= $user->getAdresse()?>, <?= $user->getVille()?> <?= $user->getCode_postale()?></td>
            <td class="text-center td-user"><?= $user->getEmail()?></td>
            <td class="text-center td-user"><a href="update-user?i=<?= $user->getId()?>"><i class="bi bi-pencil-fill"></i></a> 
            <a href="supprimer_user?id=<?= $user->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><i class="bi bi-trash"></i></a></td>
        </tr>
        <?php
            }
        } ?>
    </tbody>
</table> 
<?php include "./views/includes/footer_back.php"; ?>
</body>

</html>