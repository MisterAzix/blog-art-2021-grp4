<?php
/////////////////////////////////////////////////////
//
//  CRUD MOTCLEARTICLE (PDO) - Modifié - 22 Février 2021
//
//  Script  : motCleArticle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Mots Clés Article';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$motclearticle = new MOTCLEARTICLE();
$motcle = new MOTCLE();
$article = new ARTICLE();

$all = $motclearticle->get_AllMotCleArt();
foreach ($all as $key => $value) {
    $allOrdered[$value->numArt][$key] = $value;
}
$allMotsCles = $motcle->get_AllMotsCles();
$allArticles = $article->get_AllArticles();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Mots-Clés / Article</h1>
        <hr>
        <h2>Nouveau mot-clé sur article : <a href="./createMotCleArt.php"><i>Create a keyword-article</i></a></h2>
        <hr>
        <h2>Tous les mots-clés sur article</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Mot Clé</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allOrdered as $row) : ?>
                    <tr>
                        <td> <?= $allArticles[array_search($row[array_key_first($row)]->numArt, array_column($allArticles, 'numArt'))]->libTitrArt ?> </td>
                        <td>
                            <ul>
                                <?php foreach ($row as $value) : ?>
                                    <li> <?= $allMotsCles[array_search($value->numMotCle, array_column($allMotsCles, 'numMotCle'))]->libMotCle ?> </li>
                                <?php endforeach ?>
                            </ul>
                        </td>
                        <td><a href="./updateMotCleArt.php?numArt=<?= $row[array_key_first($row)]->numArt ?>"><i>Modifier</i></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>