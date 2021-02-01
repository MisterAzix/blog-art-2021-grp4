<?php
///////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createArticle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$article = new ARTICLE();
$angle = new ANGLE();
$thematique = new THEMATIQUE();

// Init variables form
include __DIR__ . '/initArticle.php';
$error = null;


// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['lib1Lang']) && !empty($_POST['lib2Lang']) && !empty($_POST['numPays'])) {
        $lib1Lang = ctrlSaisies($_POST['lib1Lang']);
        $lib2Lang = ctrlSaisies($_POST['lib2Lang']);
        $numPays = $_POST['numPays'];

        if (strlen($parag1Art) >= 1000 && strlen($parag2Art) >= 1000 && strlen($parag3Art) >= 1000) {
            // Ajout effectif de l'article'
            $article->create();

            header('Location: ./article.php');
        } else {
            $error = 'La longueur minimale des paragraphes est de 1000 caractères';
        }
    } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
        header('Location: ./createArticle.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$angles = $angle->get_AllAngles();
$thematiques = $thematique->get_AllThematiques();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link href="../css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Ajout d'un article</h2>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?: '' ?></div>
                    <?php endif ?>

                    <form class="form" method="post" action="" enctype="multipart/form-data">

                        <fieldset>
                            <legend class="legend1">Formulaire Langue...</legend>

                            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                            <div class="form-group mb-3">
                                <label for="lib1Lang"><b>Nom de la langue :</b></label>
                                <input class="form-control" type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang ?>" autofocus="autofocus" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="lib2Lang"><b>Libellé de la langue :</b></label>
                                <input class="form-control" type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang ?>" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="numPays"><b>Pays :</b></label>
                                <select name="numPays" class="form-control" id="numPays">
                                    <option value="">--Choississez un pays--</option>
                                    <?php foreach ($countries as $country) : ?>
                                        <option value="<?= $country->numPays ?>"><?= $country->frPays ?></option>
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
            require_once __DIR__ . '/footerLangue.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>