<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>

<main class="form_signin">

  <form method="POST" action="" class="text-center p-20 bg-gris rounded shadow">
    <?php
    if (isset($error_message)) {
      echo '<p class="text-danger">' . $error_message . '</p>';
    }
    ?>
    <h1 class="h3 mb-3 fw-normal">Connexion</h1>

    <div class="mb-4">
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

    <input class="btn btn btn-primary mb-3" type="submit" name="submit" value="connexion">

    <p class="box-login"> <a href="inscription" class="text-dark">Créer un compte</a></p>
  </form>
</main>
<?php
include "./views/includes/footer.php";
?>