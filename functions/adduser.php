<?php
require_once '../functions/db.php';

// Cette fonction permettra de pouvoir nous inscrire sur notre site web
function adduser(string $lastname, string $firstname, string $email, string $password, string $picture, int $balance) : bool
{
    $pdo = getPdo();

    $query = "INSERT INTO users (lastname, firstname, email, password, picture, balance) VALUES (:lastname, :firstname, :email, :password, :picture, :balance)";
    $stmt = $pdo->prepare($query);

    return $stmt->execute([
        'lastname' => $lastname,
        'firstname' => $firstname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
        'picture' => $picture,
        'balance' => $balance
    ]);
}
