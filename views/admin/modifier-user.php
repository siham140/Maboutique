<?php
include "./views/includes/head_back.php";
include "./views/includes/header_back.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifier un utilisateur</h1>
  </div>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <form method="POST" action="">
          <h1 class="h3 mb-3 fw-normal">Modifier utilisateur</h1>
          <div class="mb-4">
        <input type="text"  class="form-control" name="nom" placeholder="nom" value="<?=$users->getNom()?>">
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="prenom" placeholder="prenom" value="<?=$users->getPrenom()?>">
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="adresse" placeholder="adresse" value="<?=$users->getAdresse()?>" >
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="ville" placeholder="ville" value="<?=$users->getVille()?>" >
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="code_postale" placeholder="code postal" value="<?=$users->getCode_postale()?>" >
        </div>
        <div>
          <input type="email" class="form-control"  name="email" placeholder="name@example.com" value="<?=$users->getEmail()?>">
        </div>
          <input class="btn btn btn-primary mt-3" type="submit" name="submit" value="envoyer">
        </form>
      </div>
    </div>
  </section>
</main>
</div>
<?php
include "./views/includes/footer_back.php";
?>