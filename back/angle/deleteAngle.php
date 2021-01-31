<?php
///////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteAngle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$langue = new LANGUE();
$angle = new ANGLE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initAngle.php';
$error = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numAngl = ctrlSaisies($_GET['id']);
    $result = $angle->get_1Angle($numAngl);
    if (!$result) header('Location: ./angle.php');
    $libAngl = ctrlSaisies($result->libAngl);
    $selectedLang = ctrlSaisies($result->numLang);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Submit'])) {
            switch ($_POST['Submit']) {
                case 'Valider':
                    $articles = $article->get_AllArticlesByAngl($numLang);

                    if (!$articles) {
                        // Suppression effective de l'angle
                        $count = $angle->delete($numAngl);
                        ($count == 1) ? header('Location: ./angle.php') : die('Erreur delete ANGLE !');
                    } else {
                        $error = "Suppression impossible, existence d'article(s) associé(s) à cet angle. Vous devez d'abord les supprimer pour supprimer l'angle.";
                    }
                    break;

                default:
                    header('Location: ./angle.php');
                    break;
            }
        }
    }
}

$languages = $langue->get_AllLangues();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link href="../css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Suppression d'un angle</h2>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?: '' ?></div>
                    <?php endif ?>

                    <form class="form" method="post" action="" enctype="multipart/form-data">

                        <fieldset>
                            <legend class="legend1">Formulaire Angle...</legend>

                            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                            <div class="form-group mb-3">
                                <label for="libAngl"><b>Nom de l'angle :</b></label>
                                <input class="form-control" type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl ?>" autofocus="autofocus" disabled />
                            </div>

                            <div class="form-group mb-3">
                                <label for="numLang"><b>Langues :</b></label>
                                <select name="numLang" class="form-control" id="numLang" disabled>
                                    <option value="">--Choississez une langue--</option>
                                    <?php foreach ($languages as $language) : ?>
                                        <option value="<?= $language->numLang ?>" <?= ($language->numLang === $selectedLang) ? 'selected' : '' ?>><?= $language->lib1Lang ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary" />
                                <input type="submit" value="Valider" name="Submit" class="btn btn-success" />
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <?php
            require_once __DIR__ . '/footerAngle.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>