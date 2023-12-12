<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>
<main>
<section class="info-livraison">
<h2><?php echo $nom; ?> <?php echo $prenom; ?></h2><br>
    <span><?php echo $adresse; ?></span><br>
    <span class="capitalize"><?php echo $ville; ?></span>
    <span> <?php echo $code_postale; ?></span>

<!-- <form method="post" class="col-6 mx-auto">
        <input type="submit" name="submit" value="Livrer à cette adresse" class="p-2">
    </form> -->
   
    <div class="btn-container">
            <a href="paiement" class="btn btn-warning mb-3">Livrer à cette adresse</a><br>
            <a href="update-adress?id=<?=$id ; ?>" class="btn btn-warning">Modifier l'adresse</a><br>
            <!-- <form method="post" action="update-adress" class="col-6 mx-auto">
        <input type="hidden" name="adresse" value="<?php echo $adresse; ?>">
        <input type="hidden" name="ville" value="<?php echo $ville; ?>">
        <input type="hidden" name="code_postale" value="<?php echo $code_postale; ?>">
        <input type="submit" name="submit" value="modifier l'adresse" class="btn btn-warning p-2">
    </form>  -->
        </div>
    </section>
</main>
<?php
include "./views/includes/footer.php";
?>
