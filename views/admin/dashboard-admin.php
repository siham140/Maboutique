<?php include "./views/includes/head_back.php"; ?>
<body class="fond-ecran">
  <header class="navbar navbar-dark sticky-top flex-md-nowrap p-3 shadow bg-header">
    <a class="navbar-brand" href="/">Maboutique.fr</a>
    <div class="d-flex flex-wrap align-items-center">
      <?php if (isset($_SESSION["logged-admin"]) && $_SESSION["logged-admin"]) : ?>
        <span class="nav-item">Bonjour, <?php echo $_SESSION["prenom"]; ?></span>
      <?php endif; ?>
      <div class="nav-item">
        <a class="nav-link px-2" href="deconnexion-admin">Deconnexion</a>
      </div>
    </div>
  </header>
  <main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="dashboard">
      <h2 class="bg-transparant"><i class="bi bi-speedometer2 mr-2"></i>Tableau de bord</h2>
    </div>
    <p class="text-white">Bienvenue, administrateur!</p>
    <div class="centrer-dashboard">
    <div class="dashboard">
      <div class="block">
        <i class="bi bi-person-circle taille-icone"></i>
        <a href="afficher_user"><p class="task-name">Utilisateurs</p></a>
      </div>
      <div class="block">
        <i class="bi bi-list-ul taille-icone"></i>
        <a href="afficher_produit"><p class="task-name">Produits</p></a>
      </div>
      <div class="block">
        <i class="bi bi-grid taille-icone" ></i>
        <a href="categories"><p class="task-name">Catégories</p></a>
      </div>
      <div class="block">
        <i class="bi bi-box-fill taille-icone"></i>
        <a href="sous-categories"><p class="task-name">Sous-catégories</p></a>
      </div>
      <div class="block">
        <i class="bi bi-stickies taille-icone"></i>
        <a href="marques"><p class="task-name">Marques</p></a>
      </div>
      <div class="block">
        <i class="bi bi-table taille-icone"></i>
        <a href="commandes"><p class="task-name">Commandes</p></a>
      </div>
    </div>
    </div>
  </main>
  <?php include "./views/includes/footer_back.php"; ?>
  </body>
  </html>