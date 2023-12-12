<?php
// On récupère l'objet "base de données"
require_once "db.php";
// Par convention, on met la première lettre d'une classe en majuscule
class Commande extends db
{
    protected int $id_users;
    protected string $date_creation;
    protected string $statut="en attente";
    protected float $total;
    protected string $paiement;
   
  
    public function getDate_creation()
    {
        return $this->date_creation;
    }
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;

        return $this;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    public static function getCommande($id): ?Commande
    {
        $db = new Commande();
        $request = $db->prepare('SELECT * FROM commande WHERE id = :id');
        $request->setFetchMode(PDO::FETCH_CLASS, 'Commande');
        $request->bindValue(":id", $id);
        $request->execute();
        $result = $request->fetch();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    public function ajouterCommande($id_users, $total, $panier,$paiement)
    {
    $date_creation = date("Y-m-d H:i:s"); ; // Date et heure actuelles
    $statut = "en attente"; // Statut initial de la commande

   $produits=new Produit();
    // Générer un numéro de commande unique
    $numeroCommande = 'CMD' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
    $_SESSION['numero_commande'] = $numeroCommande;
    $request = $this->prepare("INSERT INTO commande (numero_commande, date_creation, statut, id_users, total,paiement) VALUES (:numero_commande, :date_creation, :statut, :id_users, :total,:paiement)");
    $request->bindParam(':numero_commande', $numeroCommande, PDO::PARAM_STR);
    $request->bindParam(':date_creation', $date_creation, PDO::PARAM_STR);
    $request->bindParam(':statut', $statut, PDO::PARAM_STR);
    $request->bindParam(':id_users', $id_users, PDO::PARAM_INT);
    $request->bindParam(':total', $total, PDO::PARAM_INT);
    $request->bindParam(':paiement', $paiement, PDO::PARAM_STR);
    $request->execute();

    $idCommande = $this->lastInsertId();
    $_SESSION['validation_commande'] = [];
       if (isset($_SESSION['validation_panier'])) {
           $panier = $_SESSION['validation_panier'];
           foreach ($panier as $item) {
            $idProduit = $item['id_produit'];
            $quantite = $item['quantite'];
            $total = $quantite * $item['prix'];
            $unProduit = $produits->getProductById($idProduit);
            $nomProduit = $unProduit->getNom_produit();
            $imageProduit = $unProduit->getImage_produit();
            $_SESSION['validation_commande'][] = [
                'id_produit' => $idProduit,
                'prix' => $item['prix'],
                'quantite' => $quantite,
                'total' => $total,
                'nomProduit' => $nomProduit,
                'imageProduit' => $imageProduit,
            ];
       $requestLigneCommande = $this->prepare("INSERT INTO detail_commande (id_produit, id_commande, prix, quantite, total) VALUES (?, ?, ?, ?, ?)");
            $requestLigneCommande->execute([ $idProduit, $idCommande, $item['prix'], $quantite, $total]);
        }
    }
}
    //Afficher toutes les commandes
    public function listCommandes()
    {
        $date_creation= date("d-m-Y H:i:s"); 
        $request = $this->prepare("SELECT * FROM commande ORDER BY date_creation");
        $request->execute();
        $result = $request->fetchAll();
        return $result;
    }
      //Afficher les mode de paiement
      public static function ModeDePaiement()
      {
        $paiement=new Commande();
          $request = $paiement->prepare("SELECT DISTINCT paiement FROM commande");
          $request->execute();
          $result = $request->fetchAll();
          return $result;
      }
      public function listCommandesByUser($id_users)
      {
          $request = $this->prepare("SELECT * FROM commande where id_users=:id_users ORDER BY date_creation");
          $request->bindParam(":id_users", $id_users, PDO::PARAM_INT);
          $request->execute();
          $result = $request->fetchAll();
          return $result;
      }
    //detail de la commande
    public function getCommandeDetails(?int $id_commande) {
        try{
        $request = $this->prepare("SELECT detail_commande.*, commande.numero_commande, produit.* 
        FROM detail_commande
        INNER JOIN produit ON detail_commande.id_produit = produit.id
        INNER JOIN commande ON detail_commande.id_commande = commande.id
        WHERE detail_commande.id_commande = :id_commande");
        $request->bindParam(':id_commande', $id_commande, PDO::PARAM_INT);
        $request->execute();
        $commandeDetails = $request->fetchAll();
        return $commandeDetails ;
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
    
    }
    public function  getDetailsCommande($idCommande) {
        try{
        $request = $this->prepare("SELECT dc.id_produit, dc.prix, dc.quantite, dc.total, p.nom_produit, p.image_produit
        FROM detail_commande dc
        INNER JOIN produit p ON dc.id_produit = p.id
        WHERE dc.id_commande = :id_commande");
        $request->bindParam(':id_commande',  $idCommande, PDO::PARAM_INT);
        $request->execute();
        $commandeDetails = $request->fetchAll();
        var_dump($commandeDetails);
        return $commandeDetails ;
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
    
    }
    public function getLastInsertedCommandeId() {
        try {
            $request = $this->query("SELECT LAST_INSERT_ID()");
            return $request->fetchColumn();
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            return null; // Gérez l'erreur comme vous le souhaitez
        }
    }
    
    //calculer le total de la commande
    public function getTotalPanier($panier)
    {
        $total = 0;

        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
            foreach ($panier as $item) {
                $quantite = $_SESSION['panier'][$item['id']];
                $total += $quantite * $item['prix'];
            }
        }

        return $total;
    }

    /**
     * Get the value of paiement
     */ 
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set the value of paiement
     *
     * @return  self
     */ 
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }
}

