<body>
<header>
     <nav class="navbar navbar-dark sticky-top bg-dark header-logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/">Maboutique.fr</a>
        <ul class="nav align-center">
          <?php if (isset($_SESSION["logged-admin"]) && $_SESSION["logged-admin"]) : ?>
            <li class="nav-item">
              <span class="nav-link text-white"><?php echo $_SESSION["prenom"]; ?></span>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="deconnexion-admin">Déconnexion</a>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row">
      <nav id="navbarNav" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link text-black" aria-current="page" href="dashboard-admin"><i class="bi bi-speedometer2"></i>
                tableau de bord
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="commandes">
              <i class="bi bi-table"></i> Commandes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="afficher_produit">
                <span data-feather="shopping-cart"></span>
                <i class="bi bi-list-ul"></i> Produits
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="afficher_user">
                <span data-feather="users"></span>
                <i class="bi bi-person-circle"></i> Utilisateurs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="categories">
                <span data-feather="categorie"></span>
                <i class="bi bi-grid"></i> Catégorie
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="sous-categories">
                <span data-feather="sub_categorie"></span>
                <i class="bi bi-box-fill"></i> Sous catégorie
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-black" href="marques">
                <span data-feather="sub_categorie"></span>
                <i class="bi bi-stickies"></i> Marque
              </a>
            </li>
          </ul>
        </div>
      </nav> 
