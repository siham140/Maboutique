<main>
 <div id="carouselExample" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active bg-rose">
        <img src="./images/samsung-23.png" class="d-block mx-auto" alt="Image 1">
      <div class="carousel-caption p-0 text-start">
        <span>SAMSUNG GALAXY S23</span>
        <!-- <p>Texte de la première image.</p> -->
      </div>
    </div>
    <div class="carousel-item  bg-b">
        <img src="./images/iphone15.png" class="d-block mx-auto" alt="Image 1">
      <div class="carousel-caption p-0 text-start">
        <span>Découvrez l'Iphone 15</span>
        <!-- <p>Texte de la première image.</p> -->
      </div>
      </div>
    <div class="carousel-item bg-bleu">
        <img src="./images/google-pixel-8.png" class="d-block mx-auto" alt="Image 2">
      <div class="carousel-caption p-0 text-start">
        <span>Google pixel 8</span>
        <!-- <p>Texte de la deuxième image.</p> -->
      </div>
    </div>
    <div class="carousel-item bg-rouge-noir">
        <img src="./images/redmi-13.png" class="d-block mx-auto" alt="Image 3">
      <div class="carousel-caption  text-start">
        <span>Xiaomi 13T Pro</span>
        <!-- <p>Capturez à l'infini</p> -->
      </div>
    </div>
  </div>
</div>
    <!-- Contrôles -->
    <!-- <a class="carousel-control-prev" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> -->
  </div>
   <h2 class="mb-4 mt-4">Actualités et Nouveautés</h2>
  <?php if (isset($produits)) : ?>
    <div class="row">
      <?php foreach ($produits as $produit) : ?>
        <div class="col-md-4">
          <div class="card box-shadow mb-20 text-center">
           <img class="mx-auto" src="./images/<?= $produit->getImage_produit(); ?>" alt="image"/>
            <p class="nom-produit"><?= $produit->getNom_produit(); ?></p>
            <span class="text-success prix-produit"><?= $produit->getPrix(); ?>€</span>
            <div class="btn-detail">
              <a href="detail?s=<?= $produit->getSlug() ?>" type="button" class="btn btn-info">Voir plus de détail</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
</main>
<script>
// Recherchez le carrousel par son ID (supposons que l'ID du carrousel est "myCarousel")
const carrousel = document.getElementById("myCarousel");

// Ajoutez un gestionnaire d'événements pour empêcher le comportement par défaut
carrousel.addEventListener("click", function(event) {
  event.preventDefault(); // Empêcher le comportement par défaut du carrousel
});

// Maintenant, ajoutez des gestionnaires d'événements pour les liens "Compte" et "Panier"
document.querySelector("a[href='#compte']").addEventListener("click", function(event) {
  window.location.href = "compte"; // Rediriger vers la page de compte
  event.preventDefault(); // Empêcher le comportement par défaut du lien
});

document.querySelector("a[href='#panier']").addEventListener("click", function(event) {
  window.location.href = "panier"; // Rediriger vers la page du panier
  event.preventDefault(); // Empêcher le comportement par défaut du lien
});

</script>