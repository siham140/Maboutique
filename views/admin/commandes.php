<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Commandes</h1>
  </div>
  <table id="datatable" class="display">
    <thead>
      <tr>
        <th class="text-center">Numero de commande</th>
        <th class="text-center">date_creation</th>
        <th class="text-center">status</th>
        <th class="text-center">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($commandes)) : ?>
        <?php foreach ($commandes as $commande) : ?>
          <tr>
            <td class="text-center"><?php echo $commande['numero_commande']; ?></td>
            <td class="text-center"><?php echo $commande['date_creation']; ?></td>
            <td class="text-center"><?php echo $commande['statut']; ?></td>
            <td class="text-center"><?php echo $commande['total']; ?> €</td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <p>Aucune commande trouvée.</p>
<?php endif; ?>
<form method="post">
<input type="submit" value="Exporter" name="submit">
</form>
</main>
<?php include "./views/includes/footer_back.php"; ?>
</body>

</html>