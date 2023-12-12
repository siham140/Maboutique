<?php
// Inclusion de la classe parente "DB"
include_once "db.php";

// Définition de la classe "Categorie" qui hérite de "DB"
class Categorie extends DB {
    // Déclaration des attributs de classe
    protected string $nom_categorie;
    protected string $description_categorie;
    protected string $slug_categorie;

    // Méthode pour récupérer le nom de la catégorie
    public function getNom_categorie()
    {
        return $this->nom_categorie;
    }

    // Méthode pour définir le nom de la catégorie
    public function setNom_categorie($nom_categorie)
    {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    // Méthode pour récupérer la description de la catégorie
    public function getDescription_categorie()
    {
        return $this->description_categorie;
    }

    // Méthode pour définir la description de la catégorie
    public function setDescription_categorie($description_categorie)
    {
        $this->description_categorie = $description_categorie;
        return $this;
    }

    // Méthode pour récupérer le slug de la catégorie
    public function getSlug_categorie()
    {
        return $this->slug_categorie;
    }

    // Méthode pour définir le slug de la catégorie
    public function setSlug_categorie($slug_categorie)
    {
        $this->slug_categorie = $slug_categorie;
        return $this;
    }

    // Méthode statique pour récupérer toutes les catégories depuis la base de données
    public static function getAll()
    {
        $categorie = new Categorie();
        $stmt = $categorie->prepare('SELECT * FROM categorie');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Méthode statique pour récupérer une catégorie par ID depuis la base de données
    public static function getCategorieById($id){
        try{
            $categorie=new Categorie();
            $stmt = $categorie->prepare('SELECT * FROM categorie WHERE id = :id');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $ex){
            echo "erreur " .$ex->getMessage();
        }
    }

    // Méthode statique pour récupérer une catégorie par slug depuis la base de données
    public static function getCategorieBySlug($slug_categorie)
    {
        try{
            $categorie=new Categorie();
            $stmt = $categorie->prepare('SELECT * FROM categorie WHERE slug_categorie = :slug_categorie');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
            $stmt->bindValue(":slug_categorie", $slug_categorie);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }catch(PDOException $ex){
            echo "erreur " .$ex->getMessage();
        }
    }

    // Méthode statique pour supprimer une catégorie par ID
    public static function SupprimerCategories($id)
    {
        $conn = new Categorie();
        $result = $conn->prepare("Delete From categorie  WHERE id = :id");
        $result->bindValue(":id", $id);
        $result->execute();
    }

    // Méthode pour sauvegarder une catégorie dans la base de données
    function save(): bool
    {
        try {
            // Début d'une transaction
            $this->beginTransaction();
            $request = $this->prepare("UPDATE categorie SET  nom_categorie=:nom_categorie, description_categorie=:description_categorie WHERE id = :id");
            $request->bindValue(":id", $this->id);
            $request->bindValue(":nom_categorie", $this->nom_categorie);
            $request->bindValue(":description_categorie", $this->description_categorie);
            $request->execute();

            // Si aucune ligne n'a été mise à jour, cela signifie qu'il faut insérer une nouvelle catégorie
            if ($request->rowCount() == 0) {
                $request = $this->prepare("INSERT INTO categorie (nom_categorie, description_categorie) VALUES(:nom_categorie,:description_categorie)");
                $request->bindValue(":nom_categorie", $this->nom_categorie);
                $request->bindValue(":description_categorie", $this->description_categorie);
                $request->execute();
                $id = $this->lastInsertId();

                // Si l'ID n'a pas été inséré correctement, annuler la transaction
                if ($id == 0) {
                    $this->rollBack();
                    return false;
                } else {
                    $this->id = $id;
                }
            }
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            $this->rollBack();
            return false;
        }
        // Valider la transaction
        $this->commit();
        return true;
    }
}
