<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>

<body>
    <main>
    <section class="centrer">
        <div class="container text-center">
            <h2>Choisissez un moyen de paiement :</h2>
            <form method="POST" action="valider_commande">
                <label for="paiement">Moyen de paiement :</label>
                <select name="paiement" id="paiement">
                    <option value="paypal">PayPal</option>
                    <option value="carte bancaire">Carte bancaire</option>
                    <option value="virement bancaire">Virement bancaire</option>
                </select>
                <input class="mt-2" type="submit" name="valider" value="Valider la commande">
            </form>
        </div>
    </section>
    </main>
   
    <?php
    include "./views/includes/footer.php";
    ?>
</body>

</html>