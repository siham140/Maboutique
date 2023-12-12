<?php
include_once("db.php");
class Panier extends DB
{
    protected int $id_produit = -1;
    protected int $id_users = -1;
    protected float $total = 0;
    protected float $prix;
    protected int $quantite = 0;

    //ajouter un produit au panier
    public function ajouterAuPanier($id_produit, $quantite)
    {

        $request = $this->prepare('SELECT * FROM produit WHERE id = :id');
        $request->bindParam(":id", $id_produit, PDO::PARAM_INT);
        $request->execute();
        $produit = $request->fetch();
        if ($produit && $quantite > 0) {
            if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
                if (array_key_exists($id_produit, $_SESSION['panier'])) {
                    $_SESSION['panier'][$id_produit] += $quantite;
                } else {
                    $_SESSION['panier'][$id_produit] = $quantite;
                }
            } else {
                $_SESSION['panier'] = array($id_produit => $quantite);
            }
        } else if ($quantite == 0) {
            unset($_SESSION['panier'][$id_produit]);
        }

        return "Produit retiré du panier avec succès.";
    }
    public function mettreAJourQuantite($id_produit, $quantite)
    {
        // Vérification que la quantité est un nombre entier
        if (!is_int($quantite)) {
            return false; // La quantité n'est pas valide
        }

        if ($quantite === 0) {
            // Si la quantité est de 0, retirez le produit du panier
            unset($_SESSION['panier'][$id_produit]);
            return true; // Retrait réussi
        }

        // Vérification si le produit existe déjà dans le panier
        if (isset($_SESSION['panier'][$id_produit])) {
            $_SESSION['panier'][$id_produit] += $quantite; // Ajoutez la quantité au produit existant
            return true; // Mise à jour réussie
        }

        return false; // Le produit n'a pas été trouvé dans le panier
    }

    // Récupérer les produits du panier pour l'utilisateur à partir de la session
    public function getPanier($id_users)
    {
        $panier = $_SESSION['panier'][$id_users] ?? [];
        $produits = [];
        if (!empty($panier)) {
            $id_produit = array_keys($panier);
            $id_produit = implode(',', $id_produit);
            $request = $this->prepare("SELECT * FROM produit WHERE id IN ($id_produit)");
            $request->execute();
            $produits = $request->fetchAll();
        }

        return $produits;
    }
    public static function panier($idProduits)
    {
        $produits = new Produit();
        $idProduit = implode(',', $idProduits);
        $request = $produits->prepare("SELECT * FROM produit WHERE id IN ($idProduit)");
        $request->execute();
        $request->fetchAll();
    }
    public function validationPanier($panierProduits, $id_users)

    {
        $produits = new Produit();
        $_SESSION['validation_panier'] = [];
        $i = 0;
        foreach ($panierProduits as $item) {
            $unProduit = $produits->getProductById($item['id']);
            $nomProduit = $unProduit->getNom_produit();
            $imageProduit = $unProduit->getImage_produit();
            $idProduit = $item['id'];
            $quantite = $_SESSION['panier'][$idProduit];
            $remise = $item['remise'];

            if ($remise > 0) {
                // Si une remise est définie pour ce produit
                $prixAvecRemise = $item['prix'] * (1 - ($remise / 100));
                $totalProduit = $quantite * $prixAvecRemise;
                $element['prix'] = $prixAvecRemise;

                $request = $this->prepare("INSERT INTO panier (id_users, id_produit, prix, quantite, total) VALUES (?, ?, ?, ?, ?)");
                $request->execute([$id_users,  $idProduit, $prixAvecRemise, $quantite, $totalProduit]);
            } else {
                // Aucune remise pour ce produit, utilisez le prix normal
                $totalProduit = $quantite * $item['prix'];
                $prixAvecRemise = $item['prix']; // Prix sans remise
                $element['prix'] = $item['prix'];
                $request = $this->prepare("INSERT INTO panier (id_users, id_produit, prix, quantite, total) VALUES (?, ?, ?, ?, ?)");
                $request->execute([$id_users,  $idProduit, $item['prix'], $quantite, $totalProduit]);
            }
            $element['id_produit'] = $idProduit;
            $element['imageProduit'] = $imageProduit;
            $element['nomProduit'] = $nomProduit;
            $element['quantite'] = $quantite;
            $element['totalProduit'] =$totalProduit;
            $_SESSION['validation_panier'][$i++] = $element;
        }
    }

    // Récupérer les produits du panier
    public function getPanierProduits()
    {
        $panier = $_SESSION['panier'] ?? [];
        $produits = [];
        if (!empty($panier)) {
            $id_produit = array_keys($panier);
            $id_produit = implode(',', $id_produit);
            $request = $this->prepare("SELECT * FROM produit WHERE id IN ($id_produit)");
            $request->execute();
            $produits = $request->fetchAll();
        }
        return $produits;
    }
    //  afficher les produits du panier depuis la base de donnée
    public function getPanierElements($id_users)
    {
        // Utilisez l'ID de l'utilisateur pour récupérer les éléments du panier spécifiques à cet utilisateur
        $query = $this->prepare("SELECT * FROM panier WHERE id_users = ?");
        $query->execute([$id_users]);
        return $query->fetchAll(); // Vous pouvez ajuster cette partie en fonction de la structure de votre base de données
    }
    public function supprimerPanier($id_users)
    {
        // Exécutez la requête DELETE pour supprimer les éléments du panier de l'utilisateur
        $request = $this->prepare("DELETE FROM panier WHERE id_users = :id_users");
        $request->bindParam(':id_users', $id_users, PDO::PARAM_INT);
        $request->execute();
    }
}
