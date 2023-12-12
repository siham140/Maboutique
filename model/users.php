<?php
include_once "db.php";
class Users extends DB
{
    protected string $prenom = "";
    protected string $nom = "";
    protected string $email = "";
    protected string $password = "";
    protected string $adresse = "";
    protected string $ville = "";
    protected string $code_postale = "";
    protected string $role="";

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of code_postale
     */ 
    public function getCode_postale()
    {
        return $this->code_postale;
    }

    /**
     * Set the value of code_postale
     *
     * @return  self
     */ 
    public function setCode_postale($code_postale)
    {
        $this->code_postale = $code_postale;

        return $this;
    }

    public function __construct(int $id=-1)
    {
        parent::__construct();
    }

    public static function getUser(int $id): ?Users
    {
        $user = new Users();
        $request = $user->prepare("select * from users where id=:id");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Users');
        $request->bindValue(":id", $id);
        $request->execute();
        $result =  $request->fetch();
        if ($result) {
            return $result;
        } else {
            return $user;
        }
    }
    public static function getByEmail(?string $email): ?Users
    {
        $user = new Users();
        $request = $user->prepare("select * from users where email=:email");
        $request->setFetchMode(PDO::FETCH_CLASS, 'Users');
        $request->bindValue(":email", $email);
        $request->execute();
        $result =  $request->fetch();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function delete($id)
    {
       $this->id=$id;
        $request = $this->prepare("delete from users where id=:id");
        $request->bindValue(":id", $id);
        $request->execute();
    }
    public static function listAll(): array
    {
        $user = new Users();
        $request = $user->prepare("select * from users");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, "Users");
    }
    public static function Connexion($email,$password)
    {
        $conn = new Users();
        $query = $conn->prepare("SELECT * FROM users  WHERE email = :email");
       /*   $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Users'); */
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
    public static function initialisationPass($email, $password)
    {
        $conn = new Users();
        $mail_recup_exist = $conn->prepare("SELECT * FROM users  WHERE email = :email");
        $mail_recup_exist->bindValue(':email', $email, PDO::PARAM_STR);
        $mail_recup_exist->execute();
        $mail_recup_exist = $mail_recup_exist->rowCount();
        if ($mail_recup_exist == 1) {
            $hashedPassword = password_hash($conn->password, PASSWORD_DEFAULT);
            $recup_insert = $conn->prepare('UPDATE users SET password =? WHERE email = ?');
            $recup_insert->execute(array($hashedPassword, $email));
        } else {

            $recup_insert = $conn->prepare('INSERT INTO users(email,password) VALUES (?, ?)');
            $recup_insert->execute(array($password, $email));
        }
    }
    function save(): bool
    {
        try {
            $this->beginTransaction();
            $request = $this->prepare("update users set prenom=:prenom, nom=:nom, email=:email, adresse=:adresse, ville=:ville,code_postale=:code_postale where id=:id");
            $request->bindValue(":id", $this->id);
            $request->bindValue(":prenom", $this->prenom);
            $request->bindValue(":nom", $this->nom);
            $request->bindValue(":email", $this->email);
            $request->bindValue(":adresse", $this->adresse);
            $request->bindValue(":ville", $this->ville);
            $request->bindValue(":code_postale", $this->code_postale);
            $request->execute();
            if ($request->rowCount() == 0) {

                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

                
                $request = $this->prepare("insert into users (prenom,nom,email, password, adresse, ville,code_postale) values (:prenom,:nom,:email, :password,:adresse,:ville,:code_postale)");
                $request->bindValue(":prenom", $this->prenom);
                $request->bindValue(":nom", $this->nom);
                $request->bindValue(":email", $this->email);
                $request->bindValue(":password", $hashedPassword);
                $request->bindValue(":adresse", $this->adresse);
                $request->bindValue(":ville", $this->ville);
                $request->bindValue(":code_postale", $this->code_postale);
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
    // Modification de l'adresse de l'utilisateur
    public function updateAdress()
    {
        // Préparez la requête SQL
        $request = $this->prepare("UPDATE users SET adresse=:adresse, ville=:ville,code_postale=:code_postale where id=:id");
        $request->bindParam(":id", $this->id);
        $request->bindParam(":adresse", $this->adresse);
        $request->bindParam(":ville", $this->ville);
        $request->bindParam(":code_postale", $this->code_postale);
        // Exécutez la requête avec les valeurs de remplacement
        $request->execute();
    }
}
