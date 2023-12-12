<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<?php
if (isset($error_message1)) {
  echo '<p class="text-success text-center">' . $error_message1 . '</p>';
}
?>
 <div >
    <main class="formSignin">
      <form method="POST" action="" class=" text-center bg-gris rounded shadow">
        <div class="text-center">
          <?php
          if (isset($error_message)) {
            echo '<p class="text-danger text-center">' . $error_message . '</p>';
          }
          ?>
        </div>
        <div class="mb-4">
        <input type="text"  class="form-control" name="adresse" value="<?php echo $adresse; ?>"  placeholder="adresse" required><br>
        </div>
        <input type="text"  class="form-control" name="ville" value="<?php echo $ville; ?>" placeholder="ville" required><br>
        <div class="mb-4">
        <input type="text"  class="form-control" name="code_postale" value="<?php echo $code_postale; ?>" placeholder="code postal" required><br>
        </div>
        <input class="btn btn-primary mb-3" type="submit" name="submit" value="envoyer">
      </form>
    </main>
  </div>
<?php
include "./views/includes/footer.php";
?>