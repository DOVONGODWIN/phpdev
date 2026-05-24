<?php
function great(){
     if($_SERVER['REQUEST_METHOD']==='POST'){
        $name = $_POST['name'] ?? '';
        if(!empty($name)){
            echo "BONJOUR" . htmlspecialchars(greet($name)) . "BIENVENUE SUR LE SITE";
        }
     }
}


function getville(){
    
    if ($_SERVER['REQUEST_METHOD']==='POST'){
       $ville = $_POST['ville'] ?? '';
       if(!empty($ville)){
        echo "Vous avez recherché la ville : " . htmlspecialchars($ville);
       }

     }
}

function getVisiteur(){
    try {
        $pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=phpexo_db;charset=utf8mb4",
            "root",
            ""
        );
        echo "ok";
    } catch (PDOException $e) {
        echo "non" . $e->getMessage();
    }

    $stmt = $pdo-> query ("SELECT * FROM visiteur");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $stmt->rowCount() . " utilisateurs trouvés : <br>";
    foreach ($users as $user) {
        echo "ID: " . $user['nom'] . " - Mail: " . $user['prenom'] . " - Password: " . $user['age'] . "<br>";
    }

}

function get_user(){
    try {
        $pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=phpexo_db;charset=utf8mb4",
            "root",
            ""
        );
        echo "ok";
    } catch (PDOException $e) {
        echo "non" . $e->getMessage();
    }

    $stmt = $pdo-> query ("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $stmt->rowCount() . " utilisateurs trouvés : <br>";
    foreach ($users as $user) {
        echo "ID: " . $user['id'] . " - Mail: " . $user['mail'] . " - Password: " . $user['password'] . "<br>";
    }

}
?>

