<?php
///////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteArticle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTile = 'Article';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
$article = new ARTICLE();
$angle = new ANGLE();
$thematique = new THEMATIQUE();
$comment = new COMMENT();

// Init variables form
include __DIR__ . '/initArticle.php';
$error = null;
$fileName = null;
$saved = null;
$comments = null;

if (isset($_GET['id'])) {
    $numArt = ctrlSaisies($_GET['id']);
    $result = $article->get_1Article($numArt);
    if (!$result) header('Location: ./article.php');
    $libTitrArt = ctrlSaisies($result->libTitrArt);
    $libChapoArt = ctrlSaisies($result->libChapoArt);
    $libAccrochArt = ctrlSaisies($result->libAccrochArt);
    $parag1Art = ctrlSaisies($result->parag1Art);
    $libSsTitr1Art = ctrlSaisies($result->libSsTitr1Art);
    $parag2Art = ctrlSaisies($result->parag2Art);
    $libSsTitr2Art = ctrlSaisies($result->libSsTitr2Art);
    $parag3Art = ctrlSaisies($result->parag3Art);
    $libConclArt = ctrlSaisies($result->libConclArt);
    $selectedAngl = ctrlSaisies($result->numAngl);
    $selectedThem = ctrlSaisies($result->numThem);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Submit'])) {
            switch ($_POST['Submit']) {
                case 'Supprimer':
                    $comments = $comment->get_AllCommentsByArticle($numArt);

                    if (!$comments) {
                        // Suppression effective de l'article
                        $count = $article->delete($numArt);
                        ($count == 1) ? header('Location: ./article.php') : die('Erreur delete ARTICLE !');
                    } else {
                        $error = "Suppression impossible, existence d'angle(s), de mot(s) clé(s) ou de thématique(s) associé(s) à cette langue. Vous devez d'abord les supprimer pour supprimer la langue.";
                    }
                    break;

                default:
                    header('Location: ./article.php');
                    break;
            }
        }
    }
}

$perpectives = $angle->get_AllAngles();
$thematics = $thematique->get_AllThematiques();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Suppression d'un article</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" disabled/>

                    <div class="row">
                        <div class="form-group mb-3 col-6">

                            <label for="libTitrArt"><b>Titre de l'article :</b></label>
                            <div class="input-group">
                                <input data-maxlength="100" class="form-control" type="text" name="libTitrArt" id="libTitrArt" maxlength="100" value="<?= $libTitrArt ?>" placeholder="Un bon titre putaclic" autofocus="autofocus" disabled/>
                                <span class="input-group-text" id="libTitrArt-span">0/0</span>
                            </div>

                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="urlPhotArt"><b>Image :</b></label>
                            <input type="file" class="form-control" name="urlPhotArt" disabled>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libChapoArt"><b>Chapeau :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="500" class="form-control" type="text" name="libChapoArt" id="libChapoArt" rows="3" maxlength="500" placeholder="Chapeau vert (car je suis plein d'ideés)" disabled><?= $libChapoArt ?></textarea>
                            <span class="input-group-text" id="libChapoArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libAccrochArt"><b>Accroche :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libAccrochArt" id="libAccrochArt" maxlength="100" value="<?= $libAccrochArt ?>" placeholder="Une super accroche" disabled/>
                            <span class="input-group-text" id="libAccrochArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag1Art"><b>Paragraphe 1 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag1Art" id="parag1Art" rows="5" maxlength="1200" placeholder="Premièrement..." disabled><?= $parag1Art ?></textarea>
                            <span class="input-group-text" id="parag1Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libSsTitr1Art"><b>Intertitre 1 :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libSsTitr1Art" id="libSsTitr1Art" maxlength="100" value="<?= $libSsTitr1Art ?>" placeholder="Titre 1er article" disabled/>
                            <span class="input-group-text" id="libSsTitr1Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag2Art"><b>Paragraphe 2 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag2Art" id="parag2Art" rows="5" maxlength="1200" placeholder="Ensuite..." disabled><?= $parag2Art ?></textarea>
                            <span class="input-group-text" id="parag2Art-span">0/0</span>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label for="libSsTitr2Art"><b>Intertitre 2 :</b></label>
                        <div class="input-group">
                            <input data-maxlength="100" class="form-control" type="text" name="libSsTitr2Art" id="libSsTitr2Art" maxlength="100" value="<?= $libSsTitr2Art ?>" placeholder="Titre 2eme article" disabled/>
                            <span class="input-group-text" id="libSsTitr2Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="parag3Art"><b>Paragraphe 3 :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="1200" class="form-control" type="text" name="parag3Art" id="parag3Art" rows="5" maxlength="1200" placeholder="Dans ce troisième paragraphe..." disabled><?= $parag3Art ?></textarea>
                            <span class="input-group-text" id="parag3Art-span">0/0</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="libConclArt"><b>Conclusion :</b></label>
                        <div class="input-group">
                            <textarea data-maxlength="800" class="form-control" type="text" name="libConclArt" id="libConclArt" rows="4" maxlength="800" placeholder="En conclusion..." disabled><?= $libConclArt ?></textarea>
                            <span class="input-group-text" id="libConclArt-span">0/0</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="numAngl"><b>Angle :</b></label>
                            <select name="numAngl" class="form-control" id="numAngl" disabled>
                                <option value="">--Choississez un angle--</option>
                                <?php foreach ($perpectives as $perpective) : ?>
                                    <option value="<?= $perpective->numAngl ?>" <?= ($perpective->numAngl === $selectedAngl) ? 'selected' : '' ?>><?= $perpective->libAngl ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="numThem"><b>Thématique :</b></label>
                            <select name="numThem" class="form-control" id="numThem" disabled>
                                <option value="">--Choississez une thématique--</option>
                                <?php foreach ($thematics as $thematic) : ?>
                                    <option value="<?= $thematic->numThem ?>" <?= ($thematic->numThem === $selectedThem) ? 'selected' : '' ?>><?= $thematic->libThem ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" value="Annuler" name="Submit" class="btn btn-primary" />
                        <input type="submit" value="Supprimer" name="Submit" class="btn btn-danger" />
                    </div>
                </form>

                <?php if ($comments) : ?>
                    <h4>Commentaire<?= (count($comments) > 1) ? 's' : '' ?> à supprimer :</h4>
                    <ul>
                        <?php foreach ($comments as $comment) : ?>
                            <li><b><?= $comment->numSeqCom ?> :</b> <?= $comment->libCom ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerArticle.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>