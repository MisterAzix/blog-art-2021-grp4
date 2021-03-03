<?php
//========================================//
//
//              register.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Inscription';
$page_description = "Inscrit toi dès aujourd'hui afin de réagir à différents articles sur l'écologie !";

// Insertion classe
require_once __DIR__ . '/../../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/statut.class.php';
$membre = new MEMBRE();
$statut = new STATUT();

$error = null;

require_once __DIR__ . '/../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['g-recaptcha-response'])) {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $configData->CAPTCHA_SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        if ($responseData->success) {
            if (
                !empty($_POST['prenomMemb']) && !empty($_POST['nomMemb']) &&
                !empty($_POST['pseudoMemb']) && !empty($_POST['email1Memb']) &&
                !empty($_POST['pass1Memb'])
            ) {
                $prenomMemb = $_POST['prenomMemb'];
                $nomMemb = $_POST['nomMemb'];
                $pseudoMemb = $_POST['pseudoMemb'];
                $eMailMemb = $_POST['email1Memb'];
                $pass1Memb = $_POST['pass1Memb'];
                $newsletter = !empty($_POST['newsletter']) ? true : false;

                if (strlen($pseudoMemb) >= 2) {
                    if (usernameCheck($pseudoMemb)) {
                        if (filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
                            if (emailCheck($eMailMemb)) {
                                if (passCheck($pass1Memb)) {
                                    if (!empty($_POST['cgu'])) {
                                        $passMemb = password_hash($pass1Memb, PASSWORD_DEFAULT, ['cost' => 12]);

                                        // Ajout effectif d'un membre
                                        $membre->create($prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb, 1, true, $newsletter);
                                        header('Location: ./connexion');
                                        /* header('Location: ./login.php'); */
                                    } else {
                                        $error = "Merci d'accepter les conditions générales d'utilisation.";
                                    }
                                } else {
                                    $error = 'Le mot de passe doit contenir entre 8 et 64 caractère, au moins une minuscule, une majuscule et un nombre !';
                                }
                            } else {
                                $error = 'L\'adresse mail est déjà utilisée.';
                            }
                        } else {
                            $error = 'Adresse mail invalide.';
                        }
                    } else {
                        $error = 'Le pseudo est déjà utilisé.';
                    }
                } else {
                    $error = "La longueur minimale du pseudo est de 2 caractères !";
                }
            } else {
                $error = 'Merci de renseigner tous les champs du formulaire.';
            }
        } else {
            $error = "Captcha invalide !";
        }
    } else {
        $error = "Captcha invalide !";
    }
}

/**
 * usernameCheck Permet de vérifier si le pseudo renseigné n'existe pas déjà en base de donnée
 *
 * @param  string $pseudoMemb
 * @return bool true : Le pseudo n'existe pas en base de donnée | false : Le pseudo est déjà utilisé
 */
function usernameCheck(string $pseudoMemb): bool
{
    global $membre;
    $result = $membre->get_1MembreByPseudo($pseudoMemb);
    return $result ? false : true;
}

/**
 * emailCheck Permet de vérifier si l'email renseigné n'existe pas déjà en base de donnée
 *
 * @param  string $eMailMemb
 * @return bool true : L'email n'existe pas en base de donnée | false : L'email est déjà utilisé
 */
function emailCheck(string $eMailMemb): bool
{
    global $membre;
    $result = $membre->get_1MembreByEmail($eMailMemb);
    return $result ? false : true;
}

/**
 * passCheck Permet de vérifier si le mot de passe vérifie les certaines règles
 *
 * @param  string $pass1Memb Mot de passe provenant du premier input
 * @return bool true : Le mot de passe respecte les règles | false : il ne respecte pas les règles
 */
function passCheck(string $pass1Memb): bool
{
    $uppercase = preg_match('@[A-Z]@', $pass1Memb); //Le mot de passe contient au moins une majuscule
    $lowercase = preg_match('@[a-z]@', $pass1Memb); //Le mot de passe contient au moins une minuscule
    $number = preg_match('@[0-9]@', $pass1Memb); //Le mot de passe contient au moins un chiffre

    if ($uppercase && $lowercase && $number && strlen($pass1Memb) >= 8 && strlen($pass1Memb) <= 64) {
        return true;
    }
    return false;
}

$allStatus = $statut->get_AllStatuts();

require_once __DIR__ . '/../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="sign_container layout">
    <div class="illustration">
        <img src="/front/assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage">
        <!-- <img src="../../assets/images/Capture_d_écran_2021-02-09_à_15.47.20-removebg.png" alt="loginImage"> -->
    </div>
    <div class="register">
        <?php if ($error) : ?>
            <span id="error" style="display: none;"><?= $error ?></span>
        <?php endif ?>

        <h1>Hey ! Inscris-toi ici ! </h1>
        <div class="input_container">
            <form action="" method="POST">
                <div class="input-group">
                    <input class="input" name="prenomMemb" type="text" placeholder="Renseigne ton prénom" required />
                    <label for="prenomMemb">Prénom *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="nomMemb" type="text" placeholder="Renseigne ton nom" required />
                    <label for="nomMemb">Nom *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="pseudoMemb" type="text" placeholder="Renseigne ton pseudo" required />
                    <label for="pseudoMemb">Pseudo *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="email1Memb" type="email" placeholder="Renseigne ton email" required />
                    <label for="email1Memb">Email *</label>
                </div>
                <div class="input-group">
                    <input class="input" name="pass1Memb" type="password" placeholder="Renseigne ton mot de passe" required />
                    <label for="pass1Memb">Mot de passe *</label>
                    <span class="tips">Le mot de passe doit contenir entre 8 et 64 caractères, des lettres minuscules et majuscules et au moins un caractère spécial.</span>
                </div>

                <div class="checkbox-container">
                    <div class="checkbox">
                        <input type="checkbox" id="cgu" name="cgu">
                        <label for="cgu">J'accepte les <a href="/cgu">conditions générales d'utilisations</a>.</label>
                    </div>

                    <div class="checkbox">
                        <input type="checkbox" id="newsletter" name="newsletter">
                        <label for="newsletter">J'adhère à la newsletter.</label>
                    </div>
                </div>
                <!-- CAPTCHA -->
                <div class="d-flex justify-content-center">
                    <div class="g-recaptcha" data-sitekey="<?= $configData->CAPTCHA_SITE_KEY ?>"></div>
                </div>
                <div class="input-group">
                    <button class="button button-submit">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once __DIR__ . '/../commons/footer.php' ?>