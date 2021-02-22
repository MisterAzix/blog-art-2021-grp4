<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MOTCLEART (PDO) - Code Modifié - 12 Février 2021
//
//  Script  : createMotCleArt.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$motclearticle = new MOTCLEARTICLE();
$motcle = new MOTCLE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initMotCleArticle.php';
$error = null;

// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['numArt']) && !empty($_POST['numMotCle']) && count($_POST['numMotCle']) > 0) {
        $numArt = $_POST['numArt'];

        foreach ($_POST['numMotCle'] as $numMotCle) {
            $motclearticle->createOrDelete($numArt, $numMotCle);
        }
        header('Location: ./motCleArticle.php');
    } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
        header('Location: ./createMotCleArt.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$allMotsCles = $motcle->get_AllMotsCles();
$allArticles = $article->get_AllArticles();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD LikeArt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link href="../css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD MotCleArticle</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Ajout d'un mot-clé sur un article</h2>

                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?= $error ?: '' ?></div>
                    <?php endif ?>

                    <form class="form" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="numArt" value="<?= isset($_GET['numArt']) ?: '' ?>" />

                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="numArt"><b>Article :</b></label>
                                <select name="numArt" class="form-control">
                                    <option value="">--Choississez un article--</option>
                                    <?php foreach ($allArticles as $article) : ?>
                                        <option value="<?= $article->numArt ?>"><?= $article->libTitrArt ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group mb-3 col-6">
                                <label for="numMotCle[]"><b>Mots-Clés :</b></label>
                                <select name="numMotCle[]" class="form-control" multiple>
                                    <option value="">--Choississez un ou plusieurs mot(s)-clé(s)--</option>
                                    <?php foreach ($allMotsCles as $motcle) : ?>
                                        <option value="<?= $motcle->numMotCle ?>"><?= $motcle->libMotCle ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary" />
                            <input type="submit" value="Valider" name="Submit" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>

            <?php
            require_once __DIR__ . '/footerMotCleArticle.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>