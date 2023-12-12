<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<?php
if (isset($error_message1)) {
  echo '<p class="text-success text-center">' . $error_message1 . '</p>';
}
?>
    <main class="formSignin">
      <form method="POST" action="" class=" text-center bg-gris rounded shadow">
        <div class="text-center">
          <?php
          if (isset($error_message)) {
            echo '<p class="text-danger text-center">' . $error_message . '</p>';
          }
          ?>
        </div>
        <h1 class="h3 mb-3 fw-normal">Inscription</h1>
        <div class="mb-4">
          <input type="text" class="form-control"  name="prenom" placeholder="Prenom" required>
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="nom" placeholder="nom" required>
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="adresse" placeholder="adresse" required>
        </div>
        <input type="text"  class="form-control" name="ville" placeholder="ville" required>
        <div class="mb-4">
        <input type="text"  class="form-control" name="code_postale" placeholder="code postal" required>
        </div>
        <div class="mb-4">
          <input type="email" class="form-control"  name="email" placeholder="name@example.com" required>
        </div>
        <div class="mb-4">
          <input type="password" class="form-control"  name="password" placeholder="mot de passe " required>
        </div>
        <div class="mb-4">
          <input type="password" class="form-control"  name="passwordConfirm" placeholder="Confirmation de mot de passe" required>
        </div>
        <input class="btn btn-primary mt-3" type="submit" name="submit" value="envoyer">
        <p class="box-login">Vous êtes nouveau ici? <a href="connexion" class="text-dark">Se connecter</a></p>
      </form>
    </main>
<?php
include "./views/includes/footer.php";
?>