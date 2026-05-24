<?php

class data {
    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;port=3306;dbname=phpexo_db;charset=utf8mb4",
                "root",
                ""
            );
            echo "ok";
        } catch (PDOException $e) {
            echo "non" . $e->getMessage();
        }
    }

    function get_visiteur(){

        // vérification des droits d'accès à la base de données

        //$stmt = $this->pdo->query("SELECT * FROM visiteur");
        $stmt = $this->pdo->query("SELECT * FROM users");

        // faire des vérifications sur $stmt avant de l'utiliser
        
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function get_user(){

        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $stmt->rowCount() . " utilisateurs trouvés : <br>";
        foreach ($users as $user) {
            echo "ID: " . $user['id'] . " - Mail: " . $user['mail'] . " - Password: " . $user['password'] . "<br>";
        }

    }
}

?>

