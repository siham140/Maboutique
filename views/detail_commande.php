<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Ma boutique</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">
</head>
<?php
include "./views/includes/header.php";
?>
<main>
<section id="order-details">
    <h2 class="text-center">Détail de la commande</h2>
    <?php
    $TotalCommande = 0;
    ?>
    <?php foreach ($commandeDetails as $item) :
        $TotalCommande += $item['total'];
    ?>

        <div class="d-flex justify-content-center align-item-center mt-3">
            <div>
                <img class="product-image" src="/images/<?php echo $item['image_produit']; ?>" alt="Image du produit">
            </div>
            <div class="card-text mt-4">
                <p><?php echo $item['nom_produit']; ?></p>
                <p class="text-success"><?php echo $item['prix']; ?><i class="bi bi-currency-euro"></i></p>
                <p>Quantité: <?php echo $item['quantite']; ?></p>
                <h4>Total: <?php echo $item['total']; ?><i class="bi bi-currency-euro"></i></h4>
            </div>
        </div>
    <?php endforeach; ?>
    <h4 class="text-center fw-bold py-2 mt-3">Total de la commande: <?php echo  $TotalCommande; ?><i class="bi bi-currency-euro"></i></h4>
    </section>
    </main>

    <?php
    include "./views/includes/footer.php";
    ?>
    </body>

</html>