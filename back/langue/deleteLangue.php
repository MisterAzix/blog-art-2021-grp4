<?php
///////////////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteLangue.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classes
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$langue = new LANGUE();
$angle = new ANGLE();
$motcle = new MOTCLE();
$thematique = new THEMATIQUE();

// Init variables form
include __DIR__ . '/initLangue.php';
$error = null;


// controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numLang = ctrlSaisies($_GET['id']);
    $result = $langue->get_1Langue($numLang);
    if (!$result) header('Location: ./statut.php');
    $lib1Lang = ctrlSaisies($result->lib1Lang);
    $lib2Lang = ctrlSaisies($result->lib2Lang);
    $selectedPays = ctrlSaisies($result->numPays);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Submit'])) {
            $errCIR = 0;
            switch ($_POST['Submit']) {
                case 'Valider':
                    $angles = $angle->get_AllAnglesByLang($numLang);
                    $motcles = $motcle->get_AllMotClesByLang($numLang);
                    $thematiques = $thematique->get_AllThematiquesByLang($numLang);

                    if (!$angles && !$motcles && !$thematiques) {
                        // Suppression effective de la langue
                        $count = $langue->delete($numLang);
                        var_dump($count);
                        ($count == 1) ? header('Location: ./langue.php') : die('Erreur delete LANGUE !');
                    } else {
                        $errCIR = 1;
                        header("Location: ./langue.php?errCIR=$errCIR");
                    }
                    break;

                default:
                    header('Location: ./langue.php');
                    break;
            }
        }
    }
}

$countries = $langue->get_AllPays();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link href="../css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Suppression d'une langue</h2>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?: '' ?></div>
                    <?php endif ?>

                    <form class="form" method="post" action="" enctype="multipart/form-data">

                        <fieldset>
                            <legend class="legend1">Formulaire Langue...</legend>

                            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

                            <div class="form-group mb-3">
                                <label for="lib1Lang"><b>Nom de la langue :</b></label>
                                <input class="form-control" type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang ?>" disabled />
                            </div>

                            <div class="form-group mb-3">
                                <label for="lib2Lang"><b>Libellé de la langue :</b></label>
                                <input class="form-control" type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang ?>" disabled />
                            </div>

                            <div class="form-group mb-3">
                                <label for="numPays"><b>Pays :</b></label>
                                <select name="numPays" class="form-control" id="numPays">
                                    <?php foreach ($countries as $country) : ?>
                                        <option value="<?= $country->numPays ?>" <?= ($country->numPays === $selectedPays) ? 'selected' : 'disabled' ?>><?= $country->frPays ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Annuler" name="Submit" class="btn btn-primary" />
                                <input type="submit" value="Valider" name="Submit" class="btn btn-danger" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <?php
            require_once __DIR__ . '/footerLangue.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>