<?php
/////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Modifié - 15 Février 2021
//
//  Script  : likeCom.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/likecom.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
$likecom = new LIKECOM();
$membre = new MEMBRE();
$article = new ARTICLE();
$comment = new COMMENT();

// Appel méthode : toutes les langues en BDD
$all = $likecom->get_AllLikesCom();
$allMembers = $membre->get_AllMembres();
$allArticles = $article->get_AllArticles();
$allComments = $comment->get_AllComments();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Like sur Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Like sur Commentaire</h1>
            <hr>
            <h2>Nouveau like sur commentaire : <a href="./createLikeCom.php"><i>Create a like</i></a></h2>
            <hr>
            <h2>Tous les likes sur commentaire</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Article</th>
                        <th>Commentaire</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $row) : ?>
                        <tr>
                            <td> <?= $allMembers[array_search($row->numMemb, array_column($allMembers, 'numMemb'))]->pseudoMemb ?> </td>
                            <td> <?= $allArticles[array_search($row->numArt, array_column($allArticles, 'numArt'))]->libTitrArt ?> </td>
                            <td> <?= $allComments[array_search($row->numArt, array_column($allComments, 'numArt'))]->libCom ?> </td>
                            <td> <?= $row->likeC ? 'liked' : 'unliked' ?> </td>
                            <td><a href="./updateLikeCom.php?numMemb=<?= $row->numMemb ?>&numSeqCom=<?= $row->numSeqCom ?>&numArt=<?= $row->numArt ?>"><i>Modifier</i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>