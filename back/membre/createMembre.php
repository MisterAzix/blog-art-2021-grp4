<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createMembre.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['g-recaptcha-response'])) {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $configData->CAPTCHA_SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        if ($responseData->success) {
            if (
                !empty($_POST['prenomMemb']) && !empty($_POST['nomMemb']) && !empty($_POST['pseudoMemb'])
                && !empty($_POST['email1Memb']) && !empty($_POST['pass1Memb']) && !empty($_POST['pass2Memb']
                    && !empty($_POST['idStat']))
            ) {
                $prenomMemb = $_POST['prenomMemb'];
                $nomMemb = $_POST['nomMemb'];
                $pseudoMemb = $_POST['pseudoMemb'];
                $eMailMemb = $_POST['email1Memb'];
                $pass1Memb = $_POST['pass1Memb'];
                $pass2Memb = $_POST['pass2Memb'];
                $passMemb = passConfirm($pass1Memb, $pass2Memb);
                $idStat = $_POST['idStat'];

                if (strlen($prenomMemb) >= 2 && strlen($nomMemb) >= 2 && strlen($pseudoMemb) >= 2) {
                    if (passCheck($pass1Memb)) {
                        if ($passMemb) {
                            // Ajout effectif d'un membre
                            $membre->create($prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb, $idStat);
                            header('Location: ./membre.php');
                        } else {
                            $error = 'La confirmation du mot de passe est différente !';
                        }
                    } else {
                        $error = 'Le mot de passe doit contenir entre 8 et 64 caractère, au moins une minuscule, une majuscule et un nombre !';
                    }
                } else {
                    $error = "La longueur minimale du prénom, du nom ou du pseudo est de 2 caractères !";
                }
            } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
                header('Location: ./createMembre.php');
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

function passCheck(string $pass1Memb): bool
{
    $uppercase = preg_match('@[A-Z]@', $pass1Memb);
    $lowercase = preg_match('@[a-z]@', $pass1Memb);
    $number = preg_match('@[0-9]@', $pass1Memb);

    if ($uppercase && $lowercase && $number && strlen($pass1Memb) >= 8 && strlen($pass1Memb) <= 64) {
        return true;
    }
    return false;
}

function passConfirm(string $pass1Memb, string $pass2Memb)
{
    $passMemb = null;
    if ($pass1Memb === $pass2Memb) {
        $passMemb = password_hash($pass1Memb, PASSWORD_DEFAULT, ['cost' => 12]);
    }
    return $passMemb;
}

$allStatus = $statut->get_AllStatuts();
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
                    <h2>Ajout d'un membre</h2>

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
                                <label for="pass1Memb"><b>Mot de passe :</b></label>
                                <input class="form-control" type="password" name="pass1Memb" maxlength="80" value="<?= $pass1Memb ?>" placeholder="••••••••••" />
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="pass2Memb"><b>Confirmation Mot de passe :</b></label>
                                <input class="form-control" type="password" name="pass2Memb" maxlength="80" value="<?= $pass2Memb ?>" placeholder="••••••••••" />
                            </div>
                        </div>

                        <div class="form-group mb-3 d-flex justify-content-center">
                            <div class="col-6">
                                <label for="idStat"><b>Statut :</b></label>
                                <select name="idStat" class="form-control" id="idStat">
                                    <option value="">--Choississez un statut--</option>
                                    <?php foreach ($allStatus as $status) : ?>
                                        <option value="<?= $status->idStat ?>"><?= $status->libStat ?></option>
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
                            <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary m-2" />
                            <input type="submit" value="S'inscrire" name="Submit" class="btn btn-success m-2" />
                        </div>
                    </form>
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