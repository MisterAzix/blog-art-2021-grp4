<?php
//========================================//
//
//                home.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Acuueil';
$page_description = "Bienvenue sur L'écopins, Mylène Micoton pour vous servir ! Voici mon un blog traitant tout plein sujet sur l'écologie.";

require_once __DIR__ . '/../../../util/dateChangeFormat.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/thematique.class.php';
$article = new ARTICLE();
$thematique = new THEMATIQUE();

// Appel méthode : tous les angles en BDD
$allArticles = $article->get_AllArticles();
$allFavArticles = $article->get_AllFavArticles();
$allThematics = $thematique->get_AllThematiques();

require_once __DIR__ . '/../commons/header.php';
?>

<!-- WRITE HTML CODE BELOW -->
<main class="homepage_container">

    <section class="homepage-intro">
        <div class="slideshow">
            <?php foreach ($allFavArticles as $article) : ?>
                <div class="slides fade">
                    <div class="article_components_container">
                        <div class="text_container">
                            <div class="overlay">
                                <h2><?= $article->libTitrArt ?></h2>
                                <p><?= $article->libAccrochArt ?></p>
                            </div>
                            <div class="button-container">
                                <a class="button" href="./article/<?= $article->numArt ?>">Lire l'article</a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="/front/assets/images/drone.jpg" alt="photo colorée de bordeaux vue de haut">
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="line_container">
                <div class="line-item" onclick="currentSlide(1)"><span class="line">
                        <div class="animation"></div>
                    </span></div>
                <div class="line-item" onclick="currentSlide(2)"><span class="line">
                        <div class="animation"></div>
                    </span></div>
                <div class="line-item" onclick="currentSlide(3)"><span class="line">
                        <div class="animation"></div>
                    </span></div>
            </div>
        </div>
    </section>

    <section class="all_articles">
        <h2>Tous mes articles</h2>
        <div class="article">
            <?php foreach ($allArticles as $article) : ?>
                <div class="sub_article_components_container">
                    <div class="container">
                        <div class="left-part">
                            <p class="info"><?= $allThematics[array_search($article->numThem, array_column($allThematics, 'numThem'))]->libThem ?> | Publié le <?= dateChangeFormat($article->dtCreArt, "Y-m-d H:i:s", "d F Y à H\hi") ?></p>
                            <h3><?= $article->libTitrArt ?></h3>
                            <div class="text-and-button">
                                <p class="text">
                                    <?= $article->libChapoArt ?>
                                </p>
                                <div class="button-container">
                                    <a class="button" href="./article/<?= $article->numArt ?>">Lire l'article</a>
                                </div>
                            </div>
                        </div>
                        <div class="image">
                            <img src="/front/assets/images/drone.jpg" alt="photo colorée de bordeaux vue de haut">
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/../commons/footer.php' ?>