     const prixMaxInput = document.getElementById("prixMax");
    const prixMaxValue = document.getElementById("prixMaxValue");
    const marqueCheckboxes = document.querySelectorAll(".marque-checkbox");


    // Mettre à jour la valeur affichée du prix maximum lorsque l'utilisateur déplace le curseur
    prixMaxInput.addEventListener("input", () => {
        prixMaxValue.textContent = prixMaxInput.value + " €";
        filtrerProduits(); // Appelez la fonction pour filtrer les produits
    });
    // Écouteur d'événement pour les cases à cocher de sous-catégories
    marqueCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", filterProducts);
    });

    // Fonction pour filtrer les produits en fonction du prix maximum et des sous-catégories sélectionnées
    function filtrerProduits() {
        const prixMax = parseFloat(prixMaxInput.value);
        const selectedMarques = Array.from(marqueCheckboxes)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.getAttribute("data-marqueid"));

        // Sélectionnez tous les éléments de classe "product"
        const produits = document.querySelectorAll(".product");

        produits.forEach(produit => {
            const prixProduit = parseFloat(produit.getAttribute("data-prix"));
            const productMarque = produit.getAttribute("data-marqueid");
            const displayStyle = prixProduit <= prixMax && (selectedMarques.length === 0 || selectedMarques.includes(productMarque)) ? "block" : "none";
            produit.style.display = displayStyle;
        });
    }
    // Fonction pour filtrer les produits en fonction des cases à cocher de sous-catégories
    function filterProducts() {
        filtrerProduits(); // Appelez la fonction de filtrage principale
    }

    // Appelez la fonction de filtrage au chargement de la page
    filtrerProduits();
    const toggleFiltersButton = document.getElementById("toggleFilters");
    // Sélectionnez la div des filtres par son ID
    const filtersDiv = document.getElementById("filters");
    toggleFiltersButton.addEventListener("click", function() {
        // Si les filtres sont actuellement visibles, masquez-les ; sinon, affichez-les
        if (filtersDiv.style.display === "block") {
            filtersDiv.style.display = "none";
        } else {
            filtersDiv.style.display = "block";
        }
    });
