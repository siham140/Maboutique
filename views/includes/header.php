<?php
if (isset($_GET['active_page'])) {
  $_SESSION['active_page'] = $_GET['active_page'];
}
$activePage = $_SESSION['active_page'] ?? '';
?>
<body>
  <header>
      <nav class="navbar px-2 header-logo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Logo -->
        <a class="navbar-brand ml-3" href="/">Maboutique</a>
        <div class="search-container">
          <form method="GET" action="produitByCat" class="d-flex input-group w-auto my-auto mb-3 mb-md-0" id="masquer">
            <input autocomplete="off" type="search" name="recherche" class="form-control rounded" placeholder="Rechercher un produit........" />
            <span class="input-group-text border-0 d-none d-lg-flex"><i class="fas fa-search"></i></span>
          </form>
        </div>
        <div class="compte-panier">
          <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"]) : ?>
            <span class="nav-item"><?php echo $_SESSION["prenom"]; ?></span>
          <?php endif; ?>
          <ul class="nav align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle mr-2" href="compte" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link link-dark" style="color:black !important">
                <i class="bi bi-person w-24"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if (isset($_SESSION["logged"]) && $_SESSION["logged"]) : ?>
                  <a class="dropdown-item" href="commandesByUser">Mes Commandes</a>
                  <a class="dropdown-item" href="deconnexion">Déconnexion</a>
                <?php else : ?>
                  <a class="dropdown-item" href="inscription">Inscription</a>
                  <a class="dropdown-item" href="connexion">Connexion</a>
                <?php endif; ?>
              </div>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="panier" class="nav-link link-dark px-2"><i class="bi bi-cart"></i></a>
              <?php $totalProduits = 0;
              if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) :
                foreach ($_SESSION['panier'] as $id_produit => $quantite) {
                  $totalProduits += $quantite;
                }
              ?>
                <div class="panier">
                  <b><span class="nombre-produits"><?php echo $totalProduits ?></span></b>
                <?php endif; ?>
                </div>
            </li>
          </ul>
        </div>
        <div class="col-md-6 mx-auto search-containerMasque">
          <form method="GET" action="produitByCat" class="d-flex input-group w-auto my-auto mb-md-0" id="masquer">
            <input autocomplete="off" type="search" name="recherche" class="form-control rounded" placeholder="Rechercher un produit........" />
            <span class="input-group-text border-0 d-flex"><i class="fas fa-search"></i></span>
          </form>
        </div>
      </nav>
  </header>
  <nav class="navbar navbar-expand-lg bg-gray">
    <div class="collapse navbar-collapse text-center" id="navbarNav">
      <ul class="navbar-nav d-flex justify-content-center align-items-center mx-auto">
        <li class="nav-item parent-item <?= $activePage === 'nouveaute' ? 'active-link-orange' : ''; ?>">
          <a class="nav-link link1 " href="/">Nouveautés</a>
        </li>
        <?php foreach ($categories as $categorie) : ?>
          <li class="nav-item parent-item <?= $activePage === 'produitByCat' ? 'active-link-orange' : ''; ?>">
            <a class="link2 nav-link" href="produitByCat?s=<?= $categorie->getSlug_categorie() ?>"> <?= $categorie->getNom_categorie() ?></a>
          </li>
        <?php endforeach; ?>
        <li class="nav-item parent-item <?= $activePage === 'promotion' ? 'active-link-orange' : ''; ?>">
          <a class="link3 nav-link " href="promotion">Bons plans<img class="image-promo" src="/images/promo.png" alt="image-promo"></a>
        </li>
      </ul>
  </nav>
