<?php
include "db.php";
class Produit extends DB
{
    protected string $nom_produit = "";
    protected string $slug = "";
    protected string $image_produit = "";
    protected float $prix;
    protected int $stock = 0;
    protected $isOutOfStock = false;
    protected string $description_produit = "";
    protected ?int $id_subcategorie = -1;
    protected ?int $id_categorie = -1;
    protected int $remise = 0;
    protected string $dateEntree = " ";
    protected int $id_marque = -1;


    public function getNom_produit()
    {
        return $this->nom_produit;
    }
    public function setNom_produit($nom_produit)
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
    public function getImage_produit()
    {
        return $this->image_produit;
    }
    public function setImage_produit($image_produit)
    {
        $this->image_produit = $image_produit;

        return $this;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function setStock($stock) {
        $this->stock = $stock;
        if ($stock === 0) {
            $this->isOutOfStock = true;
        }
    }
    public function isOutOfStock() {
        return $this->stock <= 0;
    }
    public function getDescription_produit()
    {
        return $this->description_produit;
    }
    public function setDescription_produit($description_produit)
    {
        $this->description_produit = $description_produit;

        return $this;
    }
    public function setId_subcategorie(?int $id_subcategorie)
    {
        $this->id_subcategorie = $id_subcategorie;
        return $this;
    }
    public function getId_subcategorie()
    {
        return $this->id_subcategorie;
    }
    public function getId_categorie()
    {
        return $this->id_categorie;
    }
    public function setId_categorie(?int $id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
    public function getRemise()
    {
        return $this->remise;
    }
    public function setRemise($remise)
    {
        $this->remise = $remise;
        return $this;
    }

    public function getDateEntree()
    {
        return $this->dateEntree;
    }

    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;
        return $this;
    }
    public function getId_marque()
    {
        return $this->id_marque;
    }
    public function setId_marque($id_marque)
    {
        $this->id_marque = $id_marque;

        return $this;
    }
    // afficher tous les produits
    public static function getAll(): array
    {
        $produit = new Produit();
        $request = $produit->prepare('SELECT * FROM produit');
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->execute();
        $result = $request->fetchAll();

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // afficher tous les produits en fonction de stock
    public static function getProductByStock()
    {
        $produit = new Produit();
        $request = $produit->prepare('SELECT * FROM produit order by stock asc');
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_CLASS, 'Produit');
        return $result;
    }
    // afficher les nouveautés
    public static function getNewProduct()
    {
        $produit = new Produit();
        $request = $produit->prepare('  SELECT * FROM produit
        WHERE dateEntree >= DATE_SUB(NOW(), INTERVAL 30 DAY)');
        if ($request->execute()) {
            $result = $request->fetchAll(PDO::FETCH_CLASS, 'Produit');
            if ($result) {
                return $result;
            } else {
                return null;
            }
        }
    }
    // afficher les produits en promotion
    public static function getProductsWithDiscount()
    {
        $produit = new Produit();
        $request = $produit->prepare("
                SELECT * FROM produit
                WHERE remise > 0 ");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->execute();
        $result = $request->fetchAll();

        return $result;
    }
    // afficher les produits en promotion
    public static function getProductsWithDiscount3()
    {
        $produit = new Produit();
        $request = $produit->prepare("SELECT * FROM produit WHERE remise > 0 ORDER BY id DESC LIMIT 3");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->execute();
        $result = $request->fetchAll();

        return $result;
    }
    // afficher les produits en fonction de sous categories
    public static function getProductByCatSlug($slug_categorie)
    {
        $produit = new Produit();
        $request = $produit->prepare('SELECT * FROM produit 
                                       INNER JOIN categorie ON produit.id_categorie = categorie.id 
                                       WHERE categorie.slug_categorie = :slug_categorie');
        $request->bindValue(":slug_categorie", $slug_categorie);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_CLASS, "Produit");
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // afficher les produits en fonction de categories
    public static function getProductByCat($id_categorie): array
    {
        try {
            $produit = new Produit();
            $request = $produit->prepare('SELECT * FROM produit 
                                       INNER JOIN categorie ON produit.id_categorie = categorie.id 
                                       WHERE categorie.id = :id_categorie');
            $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
            $request->bindParam(":id_categorie", $id_categorie, PDO::PARAM_INT);
            $request->execute();
            $result = $request->fetch(PDO::FETCH_ASSOC);;
            return $result;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    // afficher les produits en fonction de l'id produit
    public static function getProductById($id)
    {
        $produit = new Produit();
        $request = $produit->prepare('SELECT * FROM produit WHERE id = :id');
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->bindValue(":id", $id);
        $request->execute();
        $result = $request->fetch();
        return $result;
    }
    //afficher les produits en fonction du slug
    public static function getProductBySlug($slug)
    {
        $produit = new Produit();
        $request = $produit->prepare("SELECT * FROM produit WHERE slug = :slug");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->bindValue(':slug', $slug, PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetch();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // Méthode pour chercher un produit dans la barre de recherche
    public static function rechercherProduits($recherche)
    {

        $produit = new Produit();
        $request = $produit->prepare("SELECT * from produit where nom_produit like '%$recherche%' or slug like '%$recherche%' or description_produit like '%$recherche%'");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $request->execute();
        $result = $request->fetchAll();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // 

public static function getMarquesForSearchResults($recherche)
 {
    $produit = new Produit();
    $request = $produit->prepare("SELECT DISTINCT p.id_marque, m.nom_marque
    FROM produit AS p
    INNER JOIN marque AS m ON p.id_marque = m.id
    WHERE p.nom_produit LIKE '%$recherche%'");
    $request->execute();
    
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

    //Méthode pour filtrer par prix
    // public static function getProductsByPrice($minPrice, $maxPrice, $orderDirection) {
    //    $produit=new Produit();
    //    $orderDirection = ($orderDirection === 'prix_desc') ? 'desc' : 'asc';
    //     $request = $produit->prepare("SELECT * FROM produit WHERE prix BETWEEN :minPrice AND :maxPrice order By prix $orderDirection");
    //     $request->setFetchMode(PDO::FETCH_CLASS, 'Produit');
    //     $request->bindParam(':minPrice', $minPrice, PDO::PARAM_INT);
    //     $request->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);
    //     $request->execute();
    //     $results = $request->fetchAll();
    //     return $results;
    // }
    public function SupprimerProduits(int $id)
    {
        $request = $this->prepare("DELETE FROM produit WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    function save(): bool
    {
        try {
            $this->beginTransaction();
            $request = $this->prepare("UPDATE produit SET nom_produit=:nom_produit, slug=:slug, image_produit=:image_produit, prix=:prix, description_produit=:description_produit, id_subcategorie=:id_subcategorie,id_categorie=:id_categorie, stock=:stock, remise=:remise, dateEntree=:dateEntree, id_marque=:id_marque WHERE id = :id");
            $request->bindValue(":id", $this->id);
            $request->bindValue(":nom_produit", $this->nom_produit);
            $request->bindValue(":slug", $this->slug);
            $request->bindValue(":image_produit", $this->image_produit);
            $request->bindValue(":prix", $this->prix);
            $request->bindValue(":description_produit", $this->description_produit);
            $request->bindValue(":id_categorie", $this->id_categorie);
            $request->bindValue(":id_subcategorie", $this->id_subcategorie);
            $request->bindValue(":stock", $this->stock);
            $request->bindValue(":remise", $this->remise);
            $request->bindValue(":dateEntree", $this->dateEntree);
            $request->bindValue(":id_marque", $this->id_marque);

            $request->execute();
            if ($request->rowCount() == 0) {
                $request = $this->prepare("INSERT INTO produit (nom_produit, slug, image_produit, prix, description_produit, id_subcategorie,id_categorie,stock, remise, dateEntree, id_marque) VALUES (:nom_produit, :slug, :image_produit, :prix, :description_produit, :id_subcategorie,:id_categorie, :stock, :remise, :dateEntree, :id_marque)");
                $request->bindValue(":nom_produit", $this->nom_produit);
                $request->bindValue(":slug", $this->slug);
                $request->bindValue(":image_produit", $this->image_produit);
                $request->bindValue(":prix", $this->prix);
                $request->bindValue(":description_produit", $this->description_produit);
                $request->bindValue(":id_categorie", $this->id_categorie);
                $request->bindValue(":id_subcategorie", $this->id_subcategorie);
                $request->bindValue(":stock", $this->stock);
                $request->bindValue(":remise", $this->remise);
                $request->bindValue(":dateEntree", $this->dateEntree);
                $request->bindValue(":id_marque", $this->id_marque);

                $request->execute();

                $id = $this->lastInsertId();
                if ($id == 0) {
                    $this->rollBack();
                    return false;
                } else {
                    $this->id = $id;
                }
            }
        } catch (Exception $e) {
            $this->rollBack();
            return false;
        }
        $this->commit();
        return true;
    }
    public static function getProduitMarque($slug_categorie)
    {
        $produit = new Produit();
        $request = $produit->prepare("SELECT DISTINCT p.id_marque, m.nom_marque
        FROM produit p
        INNER JOIN marque m ON p.id_marque = m.id
        INNER JOIN sub_categorie sb ON p.id_subcategorie = sb.id
        INNER JOIN categorie c ON sb.id_categorie = c.id
        WHERE c.slug_categorie = :slug_categorie");

        $request->bindValue(':slug_categorie', $slug_categorie);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // gestion de stock
    function updateStockProduit($id, $nouveauStock)
    {
        $produit = new Produit();
        // Préparer la requête SQL pour mettre à jour le stock
        $request = $produit->prepare("UPDATE produit SET stock = :nouveauStock WHERE id = :id");
        // Lier les paramètres
        $request->bindParam(":nouveauStock", $nouveauStock, PDO::PARAM_INT);
        $request->bindParam(":id", $id, PDO::PARAM_INT);
        // Exécuter la requête
        $request->execute();
    }
   
}
