<footer class="footer-front">
  <div class="container">
    <div class="row">
      <!-- Colonne 1 : Catégories -->
      <div class="col-12 col-md-4">
        <h5 class="marge-gauche">Catégories</h5>
        <ul>
          <?php foreach ($categories as $categorie) : ?>
            <li><a href="produitByCat?s=<?= $categorie->getSlug_categorie() ?>" class="nav-link link2"><?= $categorie->getNom_categorie() ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Colonne 2 : Informations de Contact -->
      <div class="col-12 col-md-4">
        <h5>Contact</h5>
        <ul>
          <li>Adresse : 123 Rue de l'Exemple</li>
          <li>Téléphone : +33 234 567 890</li>
          <li>Email : contact@example.com</li>
        </ul>
      </div>

      <!-- Colonne 3 : Réseaux Sociaux -->
      <div class="col-12 col-md-4">
        <h5>Réseaux Sociaux</h5>
        <ul>
          <li><a class="text-white" href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
          <li><a class="text-white" href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
          <li><a class="text-white" href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

</footer>
<div class="copyright">
  <p>&copy; 2023 Maboutique - Tous droits réservés</p>
</div>
<script>
const compteLink = document.querySelector("a[href='#compte']");
const panierLink = document.querySelector("a[href='#panier']");

compteLink.addEventListener("click", function(event) {
  console.log("Clic sur le lien Compte");
  // Rediriger vers la page de compte
  window.location.href = "compte";
  event.preventDefault(); // Empêcher le comportement par défaut du lien
});

panierLink.addEventListener("click", function(event) {
  console.log("Clic sur le lien Panier");
  // Rediriger vers la page du panier
  window.location.href = "panier";
  event.preventDefault(); // Empêcher le comportement par défaut du lien
});

</script>
<script src="./js/filter.js"></script>
<script src="./js/message_1s.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
