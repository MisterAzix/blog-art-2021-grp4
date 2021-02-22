<?php
/////////////////////////////////////////////////////
//
//  CRUD MOTCLEARTICLE (PDO) - Modifié - 22 Février 2021
//
//  Script  : motCleArticle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Mots-Clés / Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Mots-Clés / Article</h1>
            <hr>
            <h2>Nouveau mot-clé sur article : <a href="./createMotCleArt.php"><i>Create a keyord-article</i></a></h2>
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
                            <td> <?= $allArticles[array_search($row[array_key_first ($row)]->numArt, array_column($allArticles, 'numArt'))]->libTitrArt ?> </td>
                            <td><ul>
                                <?php foreach ($row as $value): ?>
                                    <li> <?= $allMotsCles[array_search($value->numMotCle, array_column($allMotsCles, 'numMotCle'))]->libMotCle ?> </li>
                                <?php endforeach ?>
                            </ul></td>
                            <td><a href="./updateMotCleArt.php?numArt=<?= $row[array_key_first ($row)]->numArt ?>"><i>Modifier</i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>