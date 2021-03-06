<?php
//========================================//
//
//               login.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Connexion';
$page_description = "Connecte toi dès maintenant pour réagir à mes articles sur l'écologie !";
$error = null;

// Insertion classe
require_once __DIR__ . '/../../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/auth.class.php';
$membre = new MEMBRE();
$auth = new AUTH();

if ($auth->is_connected()) {
    header('Location: ./accueil');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['emailOrUsername']) && !empty($_POST['password'])) {
        $login = $auth->login($_POST['emailOrUsername'], $_POST['password']);
        if ($login) {
            header('Location: ./accueil');
            /* header('Location: ./home.php'); */
        } else {
            $error = 'Identifiants incorrects !';
        }
        unset($_POST['emailOrUsername'], $_POST['password']);
    }
}

require_once __DIR__ . '/../commons/header.php';
?>

<div class='sign_container layout'>
    <div class='illustration'>
        <img src="/front/assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
        <!-- <img src="../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage"> -->
    </div>
    <div class='login'>
        <?php if ($error) : ?>
            <span id="error" style="display: none;"><?= $error ?></span>
        <?php endif ?>

        <h1>Connexion</h1>
        <div class="input_container">
            <form action="" method="POST">
                <div class="input-group">
                    <input class="input" name="emailOrUsername" type="text" placeholder="Renseigne ton pseudo ou ton email" required />
                    <label for="emailOrUsername">Pseudo ou Email</label>
                </div>
                <div class="input-group">
                    <input class="input" name="password" type="password" placeholder="Renseigne ton mot de passe" required />
                    <label for="password">Mot de passe</label>
                    <a class="tips" href="">Mot de passe oublié ?</a>
                </div>
                <div class="input-group">
                    <button class="button button-submit" type="submit">Se connecter</button>
                    <p class="tips">Pas de compte ? <a href="/inscription">Inscris-toi !</a></p>
                    <!-- <p class="tips">Pas de compte ? <a href="./register.php">Inscris-toi !</a></p> -->
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../commons/footer.php' ?>