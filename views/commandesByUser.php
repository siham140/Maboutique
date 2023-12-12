<?php
include "./views/includes/head.php";
include "./views/includes/header.php";
?>

<body>
    <main>
    <h1 class="text-center mt-4">Mes commandes</h1>
    <?php if (!empty($commandes)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Numero de commande</th>
                    <th scope="col" class="text-center">Date_creation</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Detail de la commande</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) :?>
                    <tr>
                        <td class="text-center"><?php echo $commande['numero_commande']; ?></td>
                        <td class="text-center"><?php echo $commande['date_creation']; ?></td>
                        <td class="text-center"><?php echo $commande['statut']; ?></td>
                        <td class="text-center"><?php echo $commande['total']; ?> <i class="fa fa-solid fa-euro"></i></td>
                        <td class="text-center"><a href="detail_commande/<?=bin2hex($commande['id'])?>"><i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucune commande trouvée.</p>
    <?php endif; ?>
    </main>
    <?php include "./views/includes/footer.php"; ?>
