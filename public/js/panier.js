document.addEventListener("DOMContentLoaded", function() {
    let quantiteSession; // Déclarez la variable en dehors de la fonction AJAX
    let quantiteCalculee = 0; // Initialisez la variable quantiteCalculee
    let nouvelleQuantite=0;
    commandeId=$id_commande;

    // Récupérez la quantité depuis la session côté serveur
    $.ajax({
        type: "GET",
        url: "getTotalProducts", // Remplacez par l'URL de votre endpoint côté serveur
        success: function(sessionQuantite) {
            // sessionQuantite contient la quantité depuis la session côté serveur
            quantiteSession = parseInt(sessionQuantite); // Définissez la variable à l'intérieur de cette fonction
            console.log(`Quantité en session : ${quantiteSession}`);
            
            // Ensuite, appelez une fonction pour mettre à jour la quantité totale
            updateTotalQuantity(quantiteSession);
        },
        error: function(error) {
            console.error(error);
        }
    });

    const decreaseButtons = document.querySelectorAll(".decrease");
    const increaseButtons = document.querySelectorAll(".increase");
    const prixElements = document.querySelectorAll(".prix");
    const quantiteElements = document.querySelectorAll(".quantite span");
    const newquantiteElement = document.getElementById("quantity");  
    const totalElement = document.querySelector(".total");
    const totalAmountElement = document.querySelector(".totalAmount");
    const spanNbArticles = document.getElementById('nbArticles');
    let total = parseFloat(totalElement.textContent);
    let totalAmount = parseFloat(totalAmountElement.textContent);
    let quantiteArticles = 0;

    decreaseButtons.forEach((button, index) => {
        button.addEventListener("click", function() {
            const product = button.closest(".product");
            const quantiteElement = quantiteElements[index]; 
            const prix = parseFloat(prixElements[index].textContent);
            let quantite = parseInt(quantiteElement.textContent);
    
            if (quantite > 1) {
                quantite--;
                quantiteElement.textContent = quantite;
                total -= prix;
                totalAmount -= prix;
                quantiteArticles--;
            }
            
            // Mise à jour de newquantiteElement en dehors de la vérification
            newquantiteElement.textContent = quantiteArticles;

            quantiteCalculee = quantiteSession + quantiteArticles; // Mettez à jour quantiteCalculee
            nouvelleQuantite =quantiteCalculee;
            totalElement.textContent = total.toFixed(2);
            totalAmountElement.textContent = totalAmount.toFixed(2);
            updateTotalQuantity(quantiteCalculee); // Appelez la fonction avec quantiteCalculee
            updateSessionQuantite(nouvelleQuantite) 
            updateDetailCommande(commandeId, nouvelleQuantite)
        });
    });
    
    increaseButtons.forEach((button, index) => {
        button.addEventListener("click", function() {
            const product = button.closest(".product");
            const quantiteElement = quantiteElements[index]; 
            let quantite = parseInt(quantiteElement.textContent);
            const prix = parseFloat(prixElements[index].textContent);
    
            quantite++;
            quantiteElement.textContent = quantite;
            total += prix;
            totalAmount += prix;
            quantiteArticles++;
    
            // Mise à jour de newquantiteElement en dehors de la vérification
            newquantiteElement.textContent = quantiteArticles;
            quantiteCalculee = quantiteSession + quantiteArticles; // Mettez à jour quantiteCalculee
            nouvelleQuantite =quantiteCalculee;
            totalElement.textContent = total.toFixed(2);
            totalAmountElement.textContent = totalAmount.toFixed(2);
            updateTotalQuantity(quantiteCalculee); // Appelez la fonction avec quantiteCalculee
            updateSessionQuantite(nouvelleQuantite) 
            updateDetailCommande(commandeId, nouvelleQuantite)
        });
    });

    function updateTotalQuantity(totalQuantity) {
        // Mettez à jour l'élément HTML avec la quantité totale
        document.getElementById("quantity").textContent = totalQuantity;
    }


   
    function updateSessionQuantite(nouvelleQuantite) {
        $.ajax({
            type: "POST",
            url: "updateSessionQuantite", // Assurez-vous que l'URL correspond au fichier PHP
            data: { quantite: nouvelleQuantite }, // Envoyez la nouvelle quantité
            success: function(response) {
                // Traitez la réponse du serveur (facultatif)
                console.log(response);
                console.log(`Quantité en session : ${nouvelleQuantite}`);
            },
            error: function(error) {
                // Gérez les erreurs en cas d'échec de la requête AJAX
                console.error(error);
            }
        });
    }
    function updateDetailCommande(commandeId, nouvelleQuantite) {
        // Créez un objet de requête pour mettre à jour la commande dans la base de données
        const request = new Request("updateDetailCommande", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ commandeId, nouvelleQuantite }),
        });
    
        // Effectuez la requête AJAX pour mettre à jour la commande
        fetch(request)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                // Traitez la réponse ici
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });
    }
    
});

     
             
        

