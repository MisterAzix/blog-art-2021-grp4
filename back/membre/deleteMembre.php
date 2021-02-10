<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteMembre.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/likecom.class.php';
$membre = new MEMBRE();
$likeart = new LIKEART();
$likecom = new LIKECOM();

// Init variables form
include __DIR__ . '/initMembre.php';
$error = null;
$likesart = null;
$likescom = null;

$config = file_get_contents('../../config.json');
$configData = json_decode($config);

// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numMemb = $_GET['id'];
    $result = $membre->get_1Membre($numMemb);
    if (!$result) header('Location: ./membre.php');
    $prenomMemb = $result->prenomMemb;
    $nomMemb = $result->nomMemb;
    $pseudoMemb = $result->pseudoMemb;
    $eMailMemb = $result->eMailMemb;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['g-recaptcha-response'])) {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $configData->CAPTCHA_SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);

            if ($responseData->success) {
                if (isset($_POST['Submit'])) {
                    switch ($_POST['Submit']) {
                        case 'Supprimer':
                            $likesart = $likeart->get_AllLikesArtByMembre($numMemb);
                            $likescom = $likecom->get_AllLikesComByMembre($numMemb);

                            if (!$likesart && !$likescom) {
                                // Suppression effective du membre
                                $count = $membre->delete($numMemb);
                                ($count == 1) ? header('Location: ./membre.php') : die('Erreur delete MEMBRE !');
                            } else {
                                $error = "Suppression impossible, existence de like d'article ou de commentaire associés à cette langue. Vous devez d'abord les supprimer pour supprimer le membre.";
                            }
                            break;

                        default:
                            header('Location: ./membre.php');
                            break;
                    }
                }
            } else {
                $error = "Captcha invalide !";
            }
        } else {
            $error = "Captcha invalide !";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Membre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- SCRIPT -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Suppression d'un membre</h2>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?: '' ?></div>
                    <?php endif ?>

                    <form class="form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <!-- INPUTS -->
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="prenomMemb"><b>Prénom :</b></label>
                                <input class="form-control" type="text" name="prenomMemb" pattern="[A-Za-z].{2,80}" value="<?= $prenomMemb ?>" disabled/>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="nomMemb"><b>Nom :</b></label>
                                <input class="form-control" type="text" name="nomMemb" pattern="[A-Za-z].{2,80}" value="<?= $nomMemb ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="pseudoMemb"><b>Pseudo :</b></label>
                                <input class="form-control" type="text" name="pseudoMemb" pattern="[A-Za-z0-9].{2,80}" value="<?= $pseudoMemb ?>" disabled/>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="email1Memb"><b>Email :</b></label>
                                <input class="form-control" type="email" name="email1Memb" maxlength="80" value="<?= $eMailMemb ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="pass1Memb"><b>Mot de passe actuel :</b></label>
                                <input class="form-control" type="password" name="pass1Memb" maxlength="80" value="<?= $pass1Memb ?>" disabled/>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="pass2Memb"><b>Nouveau Mot de passe :</b></label>
                                <input class="form-control" type="password" name="pass2Memb" maxlength="80" value="<?= $pass2Memb ?>" disabled/>
                            </div>
                        </div>

                        <!-- CAPTCHA -->
                        <div class="d-flex justify-content-center">
                            <div class="g-recaptcha" data-sitekey="<?= $configData->CAPTCHA_SITE_KEY ?>"></div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary m-2" />
                            <input type="submit" value="Supprimer" name="Submit" class="btn btn-danger m-2" />
                        </div>
                    </form>

                    <?php if ($likesart) : ?>
                        <h4>Like<?= (count($likesart) > 1) ? 's' : '' ?> Article à supprimer :</h4>
                        <ul>
                            <?php foreach ($likesart as $likeart) : ?>
                                <li><b><?= $likeart->numArt ?></b></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>

                    <?php if ($likescom) : ?>
                        <h4>Like<?= (count($likescom) > 1) ? 's' : '' ?> Commentaire à supprimer :</h4>
                        <ul>
                            <?php foreach ($likescom as $likecom) : ?>
                                <li><b><?= $likecom->numArt ?></b></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            </div>

            <?php
            require_once __DIR__ . '/footerMembre.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>