<?php
require_once '../functions/db.php';
require_once  '../functions/utils.php';

$pdo = getPdo();
$email=""; //On initaialise $mail a une chaine vide
$error=false;

if (!empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['email']) && isset($_POST['password'])) {
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email= :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'email' => $email
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['state'] = 'connected';
        $_SESSION['user_id'] = $row['id_users'];
        redirect('../membre/profil.php?id='.$row['id_users']);
    } else {
        $error = true;
    }
}
require_once '../views/layout/header.php';
?>
    <div class="container" >
        <br>
        <h2>Connexion</h2>
        <h6>Identifiez-vous pour accéder à votre compte membre</h6>

        <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                Les informations que vous avez rentrer n'ont pas permis de vous connecter
            </div>
        <?php } ?>

        <br>
        <main>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail..." value="<?php echo $mail; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe...">
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </main>
    </div>

<?php require_once '../views/layout/footer.php';
