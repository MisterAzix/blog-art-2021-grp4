<?php
/////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié - 12 Février 2021
//
//  Script  : likeArt.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'LikeArt';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$likeart = new LIKEART();
$membre = new MEMBRE();
$article = new ARTICLE();

$all = $likeart->get_AllLikesArt();
$allMembers = $membre->get_AllMembres();
$allArticles = $article->get_AllArticles();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Like sur Article</h1>
        <hr>
        <h2>Nouveau like sur article : <a href="./createLikeArt.php"><i>Create a like</i></a></h2>
        <hr>
        <h2>Tous les likes sur article</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Article</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $row) : ?>
                    <tr>
                        <td> <?= $allMembers[array_search($row->numMemb, array_column($allMembers, 'numMemb'))]->pseudoMemb ?> </td>
                        <td> <?= $allArticles[array_search($row->numArt, array_column($allArticles, 'numArt'))]->libTitrArt ?> </td>
                        <td> <?= $row->likeA ? 'liked' : 'unliked' ?> </td>
                        <td><a href="./updateLikeArt.php?numMemb=<?= $row->numMemb ?>&numArt=<?= $row->numArt ?>"><i>Modifier</i></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>