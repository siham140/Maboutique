<?php
include_once("db.php");;
class Marque extends DB
{
    protected string $nom_marque = "";
    protected string $slug = "";
    


    public function getNom_marque()
    {
        return $this->nom_marque;
    }
    public function setNom_marque($nom_marque)
    {
        $this->nom_marque = $nom_marque;

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
    // afficher toutes les marques
    public static function getAll(): array
    {
        $produit = new Marque();
        $request = $produit->prepare('SELECT * FROM marque');
        $request->setFetchMode(PDO::FETCH_CLASS, 'marque');
        $request->execute();
        $result = $request->fetchAll();

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
    // afficher les marques en fonction de l'id marque
    public static function getMarqueById($id): ?marque
    {
        $marque = new Marque();
        $request = $marque->prepare('SELECT * FROM marque WHERE id = :id');
        $request->setFetchMode(PDO::FETCH_CLASS, 'marque');
        $request->bindValue(":id", $id);
        $request->execute();
        $result = $request->fetch();
        return $result;
    }
    public static function getMarqueSlug($slug): ?marque
    {
        $marque = new Marque();
        $request = $marque->prepare('SELECT * FROM marque WHERE slug = :slug');
        $request->setFetchMode(PDO::FETCH_CLASS, 'marque');
        $request->bindValue(":slug", $slug);
        $request->execute();
        $result = $request->fetch();
        return $result;
    }
    public function SupprimerMarque(int $id)
    {
        $request = $this->prepare("DELETE FROM marque WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
   }

    function save(): bool
    {
        try {
            $this->beginTransaction();
            $request = $this->prepare("UPDATE marque SET nom_marque=:nom_marque, slug=:slug WHERE id = :id");
            $request->bindValue(":id", $this->id);
            $request->bindValue(":nom_marque", $this->nom_marque);
            $request->bindValue(":slug", $this->slug);
            $request->execute();
            if ($request->rowCount() == 0) {
                $request = $this->prepare("INSERT INTO marque (nom_marque, slug) values(:nom_marque, :slug)");
                $request->bindValue(":nom_marque", $this->nom_marque);
                $request->bindValue(":slug", $this->slug);
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