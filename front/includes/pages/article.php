<?php
//========================================//
//
//              article.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Article';
$page_description = "Retrouve tous mes articles sur l'écologie, évenement, acteur clé, insolite, c'est ici que ça se passe !";

require_once __DIR__ . '/../../../util/dateChangeFormat.php';

// Insertion classe ARTICLE
require_once __DIR__ . '/../../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/thematique.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/comment.class.php';
require_once __DIR__ . '/../../../CLASS_CRUD/auth.class.php';
$article = new ARTICLE();
$thematique = new THEMATIQUE();
$likeart = new LIKEART();
$comment = new COMMENT();
$auth = new AUTH();

$result = null;
$isLiked = null;

if (isset($_GET['numArt'])) {
    $result = $article->get_1Article($_GET['numArt']);
}
if (!$result) header('Location: /accueil');
/* if (!$result) header('Location: ./home.php'); */
$thematic = $thematique->get_1Thematique($result->numThem);
$likeartResult = $likeart->get_AllLikesArtByArticle($_GET['numArt']);
$likesArticle = $likeartResult ? count($likeartResult) : 0;
$commentResult = $comment->get_AllowedMainCommentsByArticle($_GET['numArt']);
$commentNumber = $commentResult ? count($commentResult) : 0;
$OtherArticles = $article->get_OtherArticles($_GET['numArt']);

$connectedMemb = $auth->get_connected_id();
$isLiked = $connectedMemb ? $likeart->isMembreLikeArticle($connectedMemb, $_GET['numArt']) : null;

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
                    <a class="like <?= $isLiked ? 'active' : '' ?>" data-numart="<?= $result->numArt ?>">
                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 7.35618C15 5.80205 13.6875 5.18041 12.9375 5.18041H10.875C11.25 4.14432 11.5312 2.90103 11.3438 1.96855C10.875 0.103608 9.46875 0 9 0H8.90625C8.53125 0 8.34375 0.207216 8.15625 0.518041L7.21875 3.41907L4.6875 6.21649H0V15.5412H4.6875V14.5051C4.875 14.5051 5.34375 14.816 5.8125 15.1268C6.9375 15.7484 8.53125 16.6809 10.0312 16.6809C12.2812 16.6809 13.0312 16.3701 13.5938 15.334C13.875 14.7124 13.875 14.1943 13.875 13.8835C14.0625 13.6763 14.3438 13.3654 14.4375 12.8474C14.5312 12.3294 14.5312 12.0185 14.4375 11.7077C14.625 11.3969 14.8125 10.9825 14.9062 10.3608C14.9062 9.84277 14.8125 9.42834 14.7188 9.11751C14.8125 8.70308 15 8.18504 15 7.35618ZM2.34375 13.9871C1.78125 13.9871 1.40625 13.5727 1.40625 12.951C1.40625 12.3294 1.78125 11.9149 2.34375 11.9149C2.90625 11.9149 3.28125 12.3294 3.28125 12.951C3.28125 13.5727 2.90625 13.9871 2.34375 13.9871ZM13.7812 9.42834C13.7812 9.42834 13.9688 9.63556 13.9688 10.1536C13.9688 10.7752 13.5938 11.0861 13.5938 11.0861L13.3125 11.3969L13.5 11.7077C13.5 11.7077 13.6875 12.0185 13.5 12.433C13.4062 12.8474 13.0312 13.1582 13.0312 13.1582L12.75 13.4691L12.9375 13.8835C12.9375 13.8835 13.125 14.2979 12.8438 14.816C12.6562 15.2304 12.4688 15.5412 10.125 15.5412C8.8125 15.5412 7.3125 14.7124 6.28125 14.0907C5.53125 13.6763 5.0625 13.4691 4.6875 13.4691V7.25257H4.78125C4.96875 7.25257 5.15625 7.14896 5.34375 7.04535L7.96875 4.14432C8.0625 4.04072 8.0625 3.93711 8.15625 3.8335L9.09375 1.03608C9.5625 1.03608 10.2188 1.2433 10.4062 2.17577C10.5 2.79742 10.3125 3.8335 9.84375 5.0768C9.75 5.38762 9.75 5.59484 9.9375 5.90566C10.0312 6.11288 10.3125 6.21649 10.5938 6.21649H12.9375C13.0312 6.21649 14.0625 6.4237 14.0625 7.35618C14.0625 8.18504 13.7812 8.59947 13.7812 8.59947L13.5 9.01391L13.7812 9.42834Z" fill="#1C1F1B" />
                        </svg>
                        <span><?= $likesArticle ?></span>
                    </a>
                    <a class="comment_button" data-numart="<?= $result->numArt ?>">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.91035 1.92374e-08C3.40318 -7.21587e-05 2.91198 0.202964 2.52187 0.573919C2.13176 0.944874 1.86734 1.46037 1.77443 2.03105C1.27585 2.1374 0.825488 2.44007 0.501404 2.8866C0.177319 3.33312 -6.30414e-05 3.89536 1.68068e-08 4.47587V11.4383C1.68068e-08 12.0978 0.228879 12.7303 0.636285 13.1966C1.04369 13.663 1.59625 13.9249 2.17241 13.9249H2.6069V14.9474C2.60688 15.1302 2.65085 15.3094 2.73397 15.4654C2.81709 15.6214 2.93615 15.7482 3.07809 15.8318C3.22003 15.9155 3.37936 15.9528 3.53859 15.9396C3.69782 15.9264 3.85079 15.8632 3.98073 15.7571L6.22266 13.9249H9.9931C10.5693 13.9249 11.1218 13.663 11.5292 13.1966C11.9366 12.7303 12.1655 12.0978 12.1655 11.4383V10.8913C12.6562 10.7766 13.0972 10.4715 13.4139 10.0274C13.7306 9.58334 13.9036 9.02767 13.9035 8.45443V3.48124C13.9035 2.55796 13.583 1.67249 13.0127 1.01963C12.4423 0.366772 11.6687 1.92374e-08 10.8621 1.92374e-08H3.91035ZM9.9931 12.9303H5.94373L3.47586 14.9474V12.9303H2.17241C1.82672 12.9303 1.49518 12.7731 1.25074 12.4933C1.00629 12.2135 0.868966 11.834 0.868966 11.4383V4.47587C0.868966 4.08018 1.00629 3.7007 1.25074 3.4209C1.49518 3.1411 1.82672 2.98392 2.17241 2.98392H9.9931C10.3388 2.98392 10.6703 3.1411 10.9148 3.4209C11.1592 3.7007 11.2966 4.08018 11.2966 4.47587V11.4383C11.2966 11.834 11.1592 12.2135 10.9148 12.4933C10.6703 12.7731 10.3388 12.9303 9.9931 12.9303ZM9.9931 1.98928H2.68076C2.77065 1.69827 2.93718 1.44633 3.15739 1.26819C3.37761 1.09005 3.64068 0.994477 3.91035 0.994639H10.8621C11.4382 0.994639 11.9908 1.25662 12.3982 1.72295C12.8056 2.18927 13.0345 2.82175 13.0345 3.48124V8.45443C13.0346 8.76309 12.9511 9.06421 12.7955 9.31628C12.6399 9.56834 12.4198 9.75896 12.1655 9.86185V4.47587C12.1655 3.81639 11.9366 3.18391 11.5292 2.71759C11.1218 2.25126 10.5693 1.98928 9.9931 1.98928Z" fill="#1C1F1B" />
                        </svg>
                        <span><?= $commentNumber ?></span>
                    </a>
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
                    <a class="like <?= $isLiked ? 'active' : '' ?>" data-numart="<?= $result->numArt ?>">
                        <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 7.35618C15 5.80205 13.6875 5.18041 12.9375 5.18041H10.875C11.25 4.14432 11.5312 2.90103 11.3438 1.96855C10.875 0.103608 9.46875 0 9 0H8.90625C8.53125 0 8.34375 0.207216 8.15625 0.518041L7.21875 3.41907L4.6875 6.21649H0V15.5412H4.6875V14.5051C4.875 14.5051 5.34375 14.816 5.8125 15.1268C6.9375 15.7484 8.53125 16.6809 10.0312 16.6809C12.2812 16.6809 13.0312 16.3701 13.5938 15.334C13.875 14.7124 13.875 14.1943 13.875 13.8835C14.0625 13.6763 14.3438 13.3654 14.4375 12.8474C14.5312 12.3294 14.5312 12.0185 14.4375 11.7077C14.625 11.3969 14.8125 10.9825 14.9062 10.3608C14.9062 9.84277 14.8125 9.42834 14.7188 9.11751C14.8125 8.70308 15 8.18504 15 7.35618ZM2.34375 13.9871C1.78125 13.9871 1.40625 13.5727 1.40625 12.951C1.40625 12.3294 1.78125 11.9149 2.34375 11.9149C2.90625 11.9149 3.28125 12.3294 3.28125 12.951C3.28125 13.5727 2.90625 13.9871 2.34375 13.9871ZM13.7812 9.42834C13.7812 9.42834 13.9688 9.63556 13.9688 10.1536C13.9688 10.7752 13.5938 11.0861 13.5938 11.0861L13.3125 11.3969L13.5 11.7077C13.5 11.7077 13.6875 12.0185 13.5 12.433C13.4062 12.8474 13.0312 13.1582 13.0312 13.1582L12.75 13.4691L12.9375 13.8835C12.9375 13.8835 13.125 14.2979 12.8438 14.816C12.6562 15.2304 12.4688 15.5412 10.125 15.5412C8.8125 15.5412 7.3125 14.7124 6.28125 14.0907C5.53125 13.6763 5.0625 13.4691 4.6875 13.4691V7.25257H4.78125C4.96875 7.25257 5.15625 7.14896 5.34375 7.04535L7.96875 4.14432C8.0625 4.04072 8.0625 3.93711 8.15625 3.8335L9.09375 1.03608C9.5625 1.03608 10.2188 1.2433 10.4062 2.17577C10.5 2.79742 10.3125 3.8335 9.84375 5.0768C9.75 5.38762 9.75 5.59484 9.9375 5.90566C10.0312 6.11288 10.3125 6.21649 10.5938 6.21649H12.9375C13.0312 6.21649 14.0625 6.4237 14.0625 7.35618C14.0625 8.18504 13.7812 8.59947 13.7812 8.59947L13.5 9.01391L13.7812 9.42834Z" fill="#1C1F1B" />
                        </svg>
                        <span><?= $likesArticle ?></span>
                    </a>
                    <a class="comment_button" data-numart="<?= $result->numArt ?>">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.91035 1.92374e-08C3.40318 -7.21587e-05 2.91198 0.202964 2.52187 0.573919C2.13176 0.944874 1.86734 1.46037 1.77443 2.03105C1.27585 2.1374 0.825488 2.44007 0.501404 2.8866C0.177319 3.33312 -6.30414e-05 3.89536 1.68068e-08 4.47587V11.4383C1.68068e-08 12.0978 0.228879 12.7303 0.636285 13.1966C1.04369 13.663 1.59625 13.9249 2.17241 13.9249H2.6069V14.9474C2.60688 15.1302 2.65085 15.3094 2.73397 15.4654C2.81709 15.6214 2.93615 15.7482 3.07809 15.8318C3.22003 15.9155 3.37936 15.9528 3.53859 15.9396C3.69782 15.9264 3.85079 15.8632 3.98073 15.7571L6.22266 13.9249H9.9931C10.5693 13.9249 11.1218 13.663 11.5292 13.1966C11.9366 12.7303 12.1655 12.0978 12.1655 11.4383V10.8913C12.6562 10.7766 13.0972 10.4715 13.4139 10.0274C13.7306 9.58334 13.9036 9.02767 13.9035 8.45443V3.48124C13.9035 2.55796 13.583 1.67249 13.0127 1.01963C12.4423 0.366772 11.6687 1.92374e-08 10.8621 1.92374e-08H3.91035ZM9.9931 12.9303H5.94373L3.47586 14.9474V12.9303H2.17241C1.82672 12.9303 1.49518 12.7731 1.25074 12.4933C1.00629 12.2135 0.868966 11.834 0.868966 11.4383V4.47587C0.868966 4.08018 1.00629 3.7007 1.25074 3.4209C1.49518 3.1411 1.82672 2.98392 2.17241 2.98392H9.9931C10.3388 2.98392 10.6703 3.1411 10.9148 3.4209C11.1592 3.7007 11.2966 4.08018 11.2966 4.47587V11.4383C11.2966 11.834 11.1592 12.2135 10.9148 12.4933C10.6703 12.7731 10.3388 12.9303 9.9931 12.9303ZM9.9931 1.98928H2.68076C2.77065 1.69827 2.93718 1.44633 3.15739 1.26819C3.37761 1.09005 3.64068 0.994477 3.91035 0.994639H10.8621C11.4382 0.994639 11.9908 1.25662 12.3982 1.72295C12.8056 2.18927 13.0345 2.82175 13.0345 3.48124V8.45443C13.0346 8.76309 12.9511 9.06421 12.7955 9.31628C12.6399 9.56834 12.4198 9.75896 12.1655 9.86185V4.47587C12.1655 3.81639 11.9366 3.18391 11.5292 2.71759C11.1218 2.25126 10.5693 1.98928 9.9931 1.98928Z" fill="#1C1F1B" />
                        </svg>
                        <span><?= $commentNumber ?></span>
                    </a>
                    <button class="button comment_button">Commentaires</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="suggestions">
            <p>Lis mes autres articles:</p>
            <div class="sug_container">
                <?php
                foreach ($OtherArticles as $other) :
                $img = file_exists("../../../upload/". (!empty($other->urlPhotArt) ? $other->urlPhotArt : 'null')) ? "/upload/$other->urlPhotArt" : "/front/assets/images/drone.jpg";
                /* $img = file_exists("../../../upload/". (!empty($other->urlPhotArt) ? $other->urlPhotArt : 'null')) ? "../../../upload/$other->urlPhotArt" : "../../assets/images/drone.jpg"; */
                ?>
                    <div class="suggestion">
                        <img src="<?= $img ?>" alt="Other Article <?= $other->numArt ?> Thumbnail">
                        <p><?= $other->libTitrArt ?></p>
                        <a class="button" href="/article/<?= $other->numArt ?>">Lire l'article</a>
                        <!-- <a class="button" href="./article.php/<?= $other->numArt ?>">Lire l'article</a> -->
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="illustration">
        <?php $img = file_exists("../../../upload/". (!empty($result->urlPhotArt) ? $result->urlPhotArt : 'null')) ? "/upload/$result->urlPhotArt" : "/front/assets/images/drone.jpg"; ?>
        <?php //$img = file_exists("../../../upload/". (!empty($result->urlPhotArt) ? $result->urlPhotArt : 'null')) ? "../../../upload/$result->urlPhotArt" : "../../assets/images/drone.jpg"; ?>
        <img src="<?= $img ?>" alt="homeImage">
    </div>

    <div class="container_comment">
        <section class="comment_container">
            <div class="header">
                <div class="infos">
                    <!-- DEBUT SVG -->
                    <svg id="closeComment" width="45" height="43" viewBox="0 0 45 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7861 31.7382L33.2147 11.262" stroke="#1C1F1B" stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M33.2147 31.7382L11.7861 11.262L33.2147 31.7382Z" stroke="#1C1F1B" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <!-- FIN SVG -->

                    <p>Commentaires (<?= $commentNumber ?>)</p>
                </div>
                <form action="" method="POST" class="comment_input">
                    <input type="text" name="numArt" value="<?= $_GET['numArt'] ?>" style="display: none;">
                    <input class="input" name="libCom" type="text" placeholder="Exprime toi..." required>
                    <!-- DEBUT SVG -->
                    <button type="submit">
                        <svg class="sendIcon" width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.5183 9.24863C20.518 9.35464 20.4872 9.45829 20.4297 9.54708C20.3722 9.63588 20.2905 9.70604 20.1943 9.74911L0.754337 18.4531C0.686619 18.4842 0.612701 18.4991 0.538337 18.4966C0.460936 18.4962 0.384478 18.4795 0.313824 18.4476C0.24317 18.4158 0.179866 18.3695 0.127936 18.3117C0.0534237 18.2234 0.00900695 18.1135 0.00122948 17.9979C-0.00654798 17.8823 0.0227252 17.7673 0.0847365 17.6697L4.55594 10.4563L11.3383 9.24863L4.55594 8.04095L0.0847365 0.827508C0.0227252 0.729965 -0.00654798 0.614937 0.00122948 0.499369C0.00900695 0.383802 0.0534237 0.273806 0.127936 0.185588C0.20457 0.0990103 0.30621 0.0388045 0.418569 0.0134342C0.530927 -0.011936 0.648352 -0.001195 0.754337 0.0441476L20.1943 8.74815C20.2905 8.79122 20.3722 8.86138 20.4297 8.95017C20.4872 9.03897 20.518 9.14262 20.5183 9.24863Z" fill="url(#paint0_linear)" />
                            <defs>
                                <linearGradient id="paint0_linear" x1="11.1528" y1="37.156" x2="-25.9348" y2="19.0903" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#9FEA9C" />
                                    <stop offset="1" stop-color="#CEFA7D" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </button>
                    <!-- FIN SVG -->
                </form>
            </div>

            <div class="separator"><span></span></div>

            <div id="comment-body">
                <?php foreach ($commentResult as $com) : ?>
                    <?php require __DIR__ . '/../components/comment.php' ?>
                    <!-- Séparateur -->
                    <div class="separator"><span></span></div>
                <?php endforeach ?>
            </div>
        </section>


    </div>
</div>

<?php require_once __DIR__ . '/../commons/footer.php' ?>