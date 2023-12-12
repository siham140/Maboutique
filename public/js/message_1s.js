  // Fonction pour masquer le message après 1 secondes
  setTimeout(function() {
    var messageContainer = document.getElementById('message-container');
    if (messageContainer) {
      messageContainer.style.display = 'none';
    }
  }, 50000); // 1000 millisecondes (1 secondes)