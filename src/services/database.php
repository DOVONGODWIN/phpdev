<?php
function connexionDB() {
    $host = 'localhost';
$user = 'root';
$password = '';  
$database = 'phpexo_db';


    $connx = mysqli_connect($host, $user, $password, $database);

    if (!$connx) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    return $connx;
}
?>