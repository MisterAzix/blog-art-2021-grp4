<?php
/////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : article.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$article = new ARTICLE();

// Appel méthode : tous les angles en BDD
$all = $article->get_AllArticles();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
            <hr>
            <h2>Nouvel article : <a href="./createArticle.php"><i>Create an article</i></a></h2>

            <?php foreach ($all as $row) : ?>

                <hr>

                <div class="row">
                    <div class="col-8">
                        <h2><?= $row->libTitrArt ?> (<?= $row->numAngl ?> - <?= $row->numThem ?>)</h2>
                        <h5><?= $row->libChapoArt ?></h5>
                        <p><?= $row->libAccrochArt ?></p>

                        <p><?= $row->parag1Art ?></p>

                        <h6><?= $row->libSsTitr1Art ?></h6>
                        <p><?= $row->parag2Art ?></p>

                        <h6><?= $row->libSsTitr2Art ?></h6>
                        <p><?= $row->parag3Art ?></p>

                        <p><?= $row->libConclArt ?></p>

                        <a href="./updateAngle.php?id=<?= $row->numArt ?>"><i>Modifier</i></a>
                        <a href="./deleteAngle.php?id=<?= $row->numArt ?>"><i>Supprimer</i></a>
                    </div>
                    <div class="col-4">
                        <img src="../../upload/<?= $row->urlPhotArt ?>" alt="">
                    </div>
                </div>

            <?php endforeach ?>

            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>