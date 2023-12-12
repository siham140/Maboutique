<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<div class="container py-4 d-flex justify-content-center align-items-center h-100 mt-4 border-bottom">
<main class="form-signin text-center w-50 p-4 bg-gris rounded shadow">
  <form method="POST" action="">
    <h1 class="h3 mb-3 fw-normal">Déja Client</h1>

    <div class="form-floating mb-4">
      <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
      <label for="floatingInput">Adresse mail</label>
    </div>
 
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Mot de passe</label>
    </div>
    <input class="btn btn btn-primary mt-3" type="submit" name="submit" value="connexion">
    <p><a href="passwordForgot" id="forgot_pswd" class="text-dark">Mot de passe oublié</a></p>
  </form>
</main>
</div>
<div class="mx-auto text-center mt-4">
<h2 class="h3 mb-3 fw-normal">Nouveau Client?</h2>
<p><a href="inscription" class="btn btn-warning">Creer mon compte</a></p>
</div>


<?php
include "./views/includes/footer.php";
?>
