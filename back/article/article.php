<?php
/////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : article.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTile = 'Article';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$article = new ARTICLE();

// Appel méthode : tous les angles en BDD
$all = $article->get_AllArticles();

require_once __DIR__ . '/../common/header.php';
?>

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

                    <a href="./updateArticle.php?id=<?= $row->numArt ?>"><i>Modifier</i></a>
                    <a href="./deleteArticle.php?id=<?= $row->numArt ?>"><i>Supprimer</i></a>
                </div>
                <div class="col-4">
                    <img class="img-fluid" src="/upload/<?= $row->urlPhotArt ?>" alt="">
                </div>
            </div>

        <?php endforeach ?>

    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>