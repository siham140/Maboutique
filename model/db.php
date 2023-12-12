<?php
/*
    Définition de l'objet de connexion à la base de données
*/

class DB extends PDO
{
    protected int $id = -1;
    public function __construct()
    {
        parent::__construct(
            "mysql:dbname=Maboutique.fr;host=127.0.0.1",
            "root",
            ""
        );
    }
     public function getId(): int
    {
        return $this->id;
    } 
}
