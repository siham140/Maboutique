<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ajouter une marque</h1>
  </div> 
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
    <h4>Ajouter une marque</h4>
    <form method="post">
        <label class="form-label">Nom de marque:</label>
        <input type="text" class="form-control" name="nom_marque">
        <label class="form-label">Slug de marque:</label>
        <input type="text" class="form-control" name="slug">
        <input type="submit" value="Ajouter marque" class="btn btn-primary my-2" name="ajouter">
    </form>
      </div>
    </div>
</section>
</main>
<?php
  include "./views/includes/footer_back.php";
  ?>
</body>
</html>