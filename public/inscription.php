<?php
require_once '../functions/db.php';
require_once '../functions/adduser.php';

require_once '../views/layout/header.php';
?>
<div class="container" >
    <br>
    <br>
<main>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Entrez votre nom...">
        </div>
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Entrez votre prénom...">
        </div>
        <div class="form-group">
            <label for="email">Adresse mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Entrez votre adresse mail...">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe </label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="Entrez votre mot de passe...">
        </div>
        <div class="form-group">
            <label for="password">Confirmation mot de passe </label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmer votre mot de passe...">
        </div>
        <div class="form-group">
            <label for="picture">Photo de profil </label>
            <br>
            <input type="file" id="picture" name="picture">
            <br>
            <p>Ajoutez votre photo de profil</p>
        </div>

        <button type="submit">Je deviens hôte</button>
    </form>
</main>
</div>

<?php

$pdo=getPdo();

if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
    if ($_POST['password1'] == $_POST['password2']) {        
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password1'];
        $solde = 5000;

        if (isset($_FILES['picture']) && !empty($_FILES['picture'])) {
            // on met le fichier dans une variable pour une meilleure lisibilité
            $file = $_FILES['picture'];

            // On récupère le nom du fichier
            $filename = $file['name'];

            // On construit le chemin de destination
            $destination = __DIR__ . "/Images/" . $filename;

            // On bouge le fichier temporaire dans la destination
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo $filename . " Correctement enregistré<br />";
                $ajout = adduser($firstname, $lastname, $email, $password, $filename, $solde);
            }
        }
    }
}

require_once '../views/layout/footer.php';
