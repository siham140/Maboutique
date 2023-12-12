<?php
include_once "db.php";
class SubCategorie extends DB
{
    protected string $nom_subcategorie;
    protected int $id_categorie = -1;
    protected string $slug_subcategorie;

    public function getNomSubCategorie()
    {
        return $this->nom_subcategorie;
    }

    public function setNomSubCategorie(string $nom_subcategorie)
    {
        $this->nom_subcategorie = $nom_subcategorie;

        return $this;
    }
    public function setId_categorie(int $id_categorie)
    {
        $this->id_categorie = $id_categorie;
        return $this;
    }
    public function getId_categorie()
    {
        return $this->id_categorie;
    }
    public function getSlug_subcategorie()
    {
        return $this->slug_subcategorie;
    }
    public function setSlug_subcategorie($slug_subcategorie)
    {
        $this->slug_subcategorie = $slug_subcategorie;

        return $this;
    }

    public static function getAll()
    {
        $sub_categorie = new SubCategorie();
        $request = $sub_categorie->prepare('SELECT * FROM sub_categorie');
        $request->setFetchMode(PDO::FETCH_CLASS, 'SubCategorie');
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, "SubCategorie");
    }
    public static function getSubCategorieById($id)
    {
        try {
            $subcategorie = new SubCategorie();
            $request = $subcategorie->prepare('SELECT * FROM sub_categorie WHERE id = :id');
            $request->setFetchMode(PDO::FETCH_CLASS, 'SubCategorie');
            $request->bindValue(":id", $id);
            $request->execute();
            $result = $request->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "erreur " . $ex->getMessage();
        }
    }
    public static function getBySlugSubcategorie($slug_subcategorie)
    {
        try {
            $subcategorie = new SubCategorie();
            $request = $subcategorie->prepare('SELECT * FROM sub_categorie WHERE slug_subcategorie = :slug_subcategorie');
            $request->setFetchMode(PDO::FETCH_CLASS, 'SubCategorie');
            $request->bindValue(":slug_subcategorie", $slug_subcategorie);
            $request->execute();
            $result = $request->fetch();
            return $result;
        } catch (PDOException $ex) {
            echo "erreur " . $ex->getMessage();
        }
    }
    // Méthode pour récupérer les sous-catégories en fonction de l'id_categorie
    public static function getSubcategoriesByCategory($slug_categorie)
    {
        $subcategorie = new SubCategorie();
        $request = $subcategorie->prepare("
            SELECT sc.*
            FROM sub_categorie sc
            INNER JOIN categorie c ON sc.id_categorie = c.id
            WHERE c.slug_categorie = :slug_categorie");
        $request->setFetchMode(PDO::FETCH_CLASS, 'SubCategorie');
        $request->bindParam(':slug_categorie', $slug_categorie, PDO::PARAM_STR);
        $request->execute();
        $result = $request->fetchAll();
        
        return $result;
    }
    

    public static function SupprimersubCategorie($id)
    {
        $subcategorie = new SubCategorie();
        $request = $subcategorie->prepare("Delete From sub_categorie  WHERE id = :id");
        $request->bindParam(":id", $id,PDO::PARAM_INT);
        $request->execute();
    }
    function save(): bool
    {

        try {
            $this->beginTransaction();
            $request = $this->prepare("UPDATE sub_categorie SET  nom_subcategorie=:nom_subcategorie,slug_subcategorie=:slug_subcategorie, id_categorie=:id_categorie WHERE id = :id");
            $request->bindValue(":id", $this->id);
            $request->bindValue(":nom_subcategorie", $this->nom_subcategorie);
            $request->bindValue(":slug_subcategorie", $this->slug_subcategorie);
            $request->bindValue(":id_categorie", $this->id_categorie);
            $request->execute();
            if ($request->rowCount() == 0) {
                $request = $this->prepare("INSERT INTO sub_categorie (nom_subcategorie,slug_subcategorie,id_categorie) VALUES(:nom_subcategorie,:slug_subcategorie, :id_categorie)");
                $request->bindValue(":nom_subcategorie", $this->nom_subcategorie);
                $request->bindValue(":slug_subcategorie", $this->slug_subcategorie);
                $request->bindValue(":id_categorie", $this->id_categorie);
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
}
