<?php
//========================================//
//
//              article.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Article';
$page_description = '';

require_once __DIR__ . '/../../../util/dateChangeFormat.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/thematique.class.php';
$article = new ARTICLE();
$thematique = new THEMATIQUE();

$result = null;

if (isset($_GET['numArt'])) {
    $result = $article->get_1Article($_GET['numArt']);
}
if (!$result) header('Location: /accueil');
$thematic = $thematique->get_1Thematique($result->numThem);

require_once __DIR__ . '/../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="article_container ">
    <div class="txt_container">
        <div class="article">
            <div class="absolute">
                <div class="info">
                    <p><?= dateChangeFormat($result->dtCreArt, "Y-m-d H:i:s", "d/m/Y") ?></p>
                    <div class="trait"></div>
                    <a href=""><img src="/front/assets/images/Vector-2.png" alt="loginImage">56</a>
                    <a href=""><img src="/front/assets/images/Vector-3.png" alt="loginImage">22</a>
                </div>
            </div>
            <div class="text">
                <h1><?= $result->libTitrArt ?></h1>
                <p class="editor"><?= $thematic->libThem ?> | Par Mylène Micoton</p>
                <p><?= $result->parag1Art ?></p>
                <h3><?= $result->libSsTitr1Art ?></h3>
                <p><?= $result->parag2Art ?></p>
                <h3><?= $result->libSsTitr2Art ?></h3>
                <p><?= $result->parag3Art ?></p>
                <div class="info_bottom">
                    <a href=""><img src="/front/assets/images/share-2 1.png" alt="loginImage"></a>
                    <a href=""><img src="/front/assets/images/Vector-2.png" alt="loginImage">56</a>
                    <a href=""><img src="/front/assets/images/Vector-3.png" alt="loginImage">22</a>
                    <button class="button">Commentaires</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="suggestions">
            <p>Lis mes autres articles:</p>
            <div class="sug_container">
                <div class="suggestion">
                    <img src="/front/assets/images/philippe-barre.jpg" alt="philippebarreImage">
                    <p>Phillipe Barre : Anticonformiste et créateur d’un éco-système</p>
                    <a class="button" href="../article/">Lire l'article</a>
                </div>
                <div class="suggestion">
                    <img src="/front/assets/images/jardin.jpg" alt="jardinImage">
                    <p>Écologique et insolite C’est possible !</p>
                    <a class="button" href="./article">Lire l'article</a>
                </div>
            </div>
        </div>
    </div>
    <div class="illustration">
        <img src="/front/assets/images/home.jpg" alt="homeImage">
    </div>

    <div class="container_comment" style="display: block;">
        <?php
        require __DIR__ . '/../components/comment.php';
        ?>
        <?php
        require __DIR__ . '/../components/sub_comment.php';
        ?>
    </div>
</div>

<?php require_once __DIR__ . '/../commons/footer.php' ?>