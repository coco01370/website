<?php

//On connecte nos base de données à notre site web grâce à cette fonction
function getPdo(): PDO
{
    // try {
    //     $pdo = new PDO (
    //         "mysql:host=localhost;dbname=projetweb",
    //         "projetweb",
    //         "D5OZCEHLVQDJ8zCi"
    //     );
    //     return $pdo;
    // } catch (PDOException $ex){
    //     exit("Erreur lors de la connexion à la base de données");
    // }
    $servername = "localhost";
    $username = "website";
    $password = "W2683cIqiWFdagbS";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=website", $username, $password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}