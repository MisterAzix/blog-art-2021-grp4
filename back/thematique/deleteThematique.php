<?php
///////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteThematique.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Thématique';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$langue = new LANGUE();
$thematique = new THEMATIQUE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initThematique.php';
$error = null;
$articles = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numThem = ctrlSaisies($_GET['id']);
    $result = $thematique->get_1Thematique($numThem);
    if (!$result) header('Location: ./thematique.php');
    $libThem = ctrlSaisies($result->libThem);
    $selectedLang = ctrlSaisies($result->numLang);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Submit'])) {
            switch ($_POST['Submit']) {
                case 'Supprimer':
                    $articles = $article->get_AllArticlesByThem($numThem);

                    if (!$articles) {
                        // Suppression effective de la thématique
                        $count = $thematique->delete($numThem);
                        ($count == 1) ? header('Location: ./thematique.php') : die('Erreur delete THEMATIQUE !');
                    } else {
                        $error = "Suppression impossible, existence d'article(s) associé(s) à cette thématique. Vous devez d'abord les supprimer pour supprimer la thématique.";
                    }
                    break;

                default:
                    header('Location: ./thematique.php');
                    break;
            }
        }
    }
}

$languages = $langue->get_AllLangues();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Thématique</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Suppression d'une thématique</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Thématique...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="libThem"><b>Nom de la thématique :</b></label>
                            <input class="form-control" type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem ?>" disabled />
                        </div>

                        <div class="form-group mb-3">
                            <label for="numLang"><b>Langues :</b></label>
                            <select name="numLang" class="form-control" id="numLang" disabled>
                                <option value="">--Choississez une langue--</option>
                                <?php foreach ($languages as $language) : ?>
                                    <option value="<?= $language->numLang ?>" <?= ($language->numLang === $selectedLang) ? 'selected' : '' ?>><?= $language->lib1Lang ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <input type="submit" value="Annuler" name="Submit" class="btn btn-primary" />
                            <input type="submit" value="Supprimer" name="Submit" class="btn btn-danger" />
                        </div>
                    </fieldset>
                </form>

                <?php if ($articles) : ?>
                    <h4>Article<?= (count($articles) > 1) ? 's' : '' ?> à supprimer :</h4>
                    <ul>
                        <?php foreach ($articles as $article) : ?>
                            <li><b><?= $article->numArt ?> :</b> <?= $article->libTitrArt ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerThematique.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>