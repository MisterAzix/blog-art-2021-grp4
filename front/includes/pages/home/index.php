<?php
//========================================//
//
//             home/index.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Home';
$page_description = '';

require_once __DIR__ . '/../../../../util/dateChangeFormat.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../../../CLASS_CRUD/thematique.class.php';
$article = new ARTICLE();
$thematique = new THEMATIQUE();

// Appel méthode : tous les angles en BDD
$allArticles = $article->get_AllArticles();
$allThematics = $thematique->get_AllThematiques();

require_once '../../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<div class="homepage_container">
    <div class="slideshow">
        <div class="slides fade">
            <?php require '../../components/article.php'; ?>
        </div>
        <div class="slides fade">
            <?php require '../../components/article.php'; ?>
        </div>
        <div class="slides fade">
            <?php require '../../components/article.php'; ?>
        </div>
        <div class="line_container">
            <span class="line" onclick="currentSlide(1)"></span>
            <span class="line" onclick="currentSlide(2)"></span>
            <span class="line" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <div class="all_articles">
        <h2>Tous mes articles</h2>
        <div class="article">
            <?php foreach ($allArticles as $article) : ?>
                <div class="sub_article_components_container">
                    <div class="container">
                        <div class="left-part">
                            <p class="info"><span class="underline"><?= $allThematics[array_search($article->numThem, array_column($allThematics, 'numThem'))]->libThem ?></span> | Publié le <?= dateChangeFormat($article->dtCreArt, "Y-m-d H:i:s", "d F Y à H\hi") ?></p>
                            <h3><?= $article->libTitrArt ?></h3>
                            <div class="text-and-button">
                                <p class="text">
                                    <?= $article->libAccrochArt ?>
                                </p>
                                <div class="button-container">
                                    <a class="button" href="../article/index.php?id=<?= $article->numArt ?>">Lire l'article</a>
                                </div>
                            </div>
                        </div>
                        <div class="image">
                            <img src="../../../assets/images/drone.jpg" alt="photo colorée de bordeaux vue de haut">
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <?php require '../../components/sub_article.php';
            ?>
            <?php require '../../components/sub_article.php';
            ?>
            <?php require '../../components/sub_article.php';
            ?>
        </div>
    </div>



</div>


<?php require_once '../../commons/footer.php' ?>