<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateMembre.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Membre';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$membre = new MEMBRE();
$statut = new STATUT();

// Init variables form
include __DIR__ . '/initMembre.php';
$error = null;

$config = file_get_contents('../../config.json');
$configData = json_decode($config);

// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numMemb = $_GET['id'];
    $result = $membre->get_1Membre($numMemb);
    if (!$result) header('Location: ./membre.php');
    $prenomMemb = ctrlSaisies($result->prenomMemb);
    $nomMemb = ctrlSaisies($result->nomMemb);
    $pseudoMemb = ctrlSaisies($result->pseudoMemb);
    $eMailMemb = ctrlSaisies($result->eMailMemb);
    $password = ctrlSaisies($result->passMemb);
    $idStat = ctrlSaisies($result->idStat);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['g-recaptcha-response'])) {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $configData->CAPTCHA_SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);

            if ($responseData->success) {
                if (
                    !empty($_POST['submit']) && $_POST['submit'] === 'Modifier' && 
                    !empty($_POST['prenomMemb']) && !empty($_POST['nomMemb']) && !empty($_POST['pseudoMemb'])
                    && !empty($_POST['email1Memb']) && !empty($_POST['pass1Memb']) && !empty($_POST['pass2Memb'])
                    && !empty($_POST['idStat'])
                ) {
                    $prenomMemb = $_POST['prenomMemb'];
                    $nomMemb = $_POST['nomMemb'];
                    $pseudoMemb = $_POST['pseudoMemb'];
                    $eMailMemb = $_POST['email1Memb'];
                    $pass1Memb = $_POST['pass1Memb'];
                    $pass2Memb = $_POST['pass2Memb'];
                    $passMemb = password_hash($pass2Memb, PASSWORD_DEFAULT, ['cost' => 12]);
                    $idStat = $_POST['idStat'];

                    if (strlen($prenomMemb) >= 2 && strlen($nomMemb) >= 2 && strlen($pseudoMemb) >= 2) {
                        if (usernameCheck($pseudoMemb)) {
                            if (filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
                                if (emailCheck($eMailMemb)) {
                                    if (passCheck($pass1Memb)) {
                                        if (passConfirm($password, $pass1Memb)) {
                                            // Ajout effectif d'un membre
                                            $membre->update($numMemb, $prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb, $idStat);
                                            header('Location: ./membre.php');
                                        } else {
                                            $error = 'Mot de passe incorrect !';
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
                        $error = "La longueur minimale du prénom, du nom ou du pseudo est de 2 caractères !";
                    }
                } else if (!empty($_POST['submit']) && $_POST['submit'] === 'Initialiser') {
                    header('Location: ./updateMembre.php?id=' . $_GET['id']);
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
}

function usernameCheck($pseudoMemb)
{
    global $membre;
    $result = $membre->get_AllMembresByPseudo($pseudoMemb);
    return $result ? false : true;
}

function emailCheck($eMailMemb)
{
    global $membre;
    $result = $membre->get_AllMembresByEmail($eMailMemb);
    return $result ? false : true;
}

function passCheck(string $pass2Memb): bool
{
    $uppercase = preg_match('@[A-Z]@', $pass2Memb);
    $lowercase = preg_match('@[a-z]@', $pass2Memb);
    $number = preg_match('@[0-9]@', $pass2Memb);

    if ($uppercase && $lowercase && $number && strlen($pass2Memb) >= 8 && strlen($pass2Memb) <= 64) {
        return true;
    }
    return false;
}

function passConfirm(string $password, string $pass1Memb): bool
{
    if (password_verify($pass1Memb, $password)) return true;
    return false;
}

$allStatus = $statut->get_AllStatuts();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Modification d'un membre</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                    <!-- INPUTS -->
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="prenomMemb"><b>Prénom :</b></label>
                            <input class="form-control" type="text" name="prenomMemb" pattern="[A-Za-z].{2,80}" value="<?= $prenomMemb ?>" placeholder="John" autofocus="autofocus" />
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="nomMemb"><b>Nom :</b></label>
                            <input class="form-control" type="text" name="nomMemb" pattern="[A-Za-z].{2,80}" value="<?= $nomMemb ?>" placeholder="Doe" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="pseudoMemb"><b>Pseudo :</b></label>
                            <input class="form-control" type="text" name="pseudoMemb" pattern="[A-Za-z0-9].{2,80}" value="<?= $pseudoMemb ?>" placeholder="JohnD33" />
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="email1Memb"><b>Email :</b></label>
                            <input class="form-control" type="email" name="email1Memb" maxlength="80" value="<?= $eMailMemb ?>" placeholder="john@doe.fr" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="pass1Memb"><b>Mot de passe actuel :</b></label>
                            <input class="form-control" type="password" name="pass1Memb" maxlength="80" value="<?= $pass1Memb ?>" placeholder="••••••••••" />
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="pass2Memb"><b>Nouveau Mot de passe :</b></label>
                            <input class="form-control" type="password" name="pass2Memb" maxlength="80" value="<?= $pass2Memb ?>" placeholder="••••••••••" />
                        </div>
                    </div>

                    <div class="form-group mb-3 d-flex justify-content-center">
                        <div class="col-6">
                            <label for="idStat"><b>Statut :</b></label>
                            <select name="idStat" class="form-control" id="idStat">
                                <option value="">--Choississez un statut--</option>
                                <?php foreach ($allStatus as $status) : ?>
                                    <option value="<?= $status->idStat ?>" <?= ($status->idStat === $idStat) ? 'selected' : '' ?>><?= $status->libStat ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <!-- CAPTCHA -->
                    <div class="d-flex justify-content-center">
                        <div class="g-recaptcha" data-sitekey="<?= $configData->CAPTCHA_SITE_KEY ?>"></div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" value="Initialiser" name="submit" class="btn btn-primary m-2" />
                        <input type="submit" value="Modifier" name="submit" class="btn btn-success m-2" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerMembre.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>