<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteMotCle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Mot Clé';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$langue = new LANGUE();
$motcle = new MOTCLE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initMotCle.php';
$error = null;
$articles = null;

// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $numMotCle = ctrlSaisies($_GET['id']);
    $result = $motcle->get_1MotCle($numMotCle);
    if (!$result) header('Location: ./motcle.php');
    $libMotCle = ctrlSaisies($result->libMotCle);
    $selectedLang = ctrlSaisies($result->numLang);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Submit'])) {
            switch ($_POST['Submit']) {
                case 'Valider':
                    $articles = $article->get_AllArticlesByAngl($numMotCle);

                    if (!$articles) {
                        // Suppression effective du mot clé
                        $count = $motcle->delete($numMotCle);
                        ($count == 1) ? header('Location: ./motcle.php') : die('Erreur delete MOTCLE !');
                    } else {
                        $error = "Suppression impossible, existence d'article(s) associé(s) à ce mot clé. Vous devez d'abord les supprimer pour supprimer le mot clé.";
                    }
                    break;

                default:
                    header('Location: ./motcle.php');
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
        <h1>BLOGART21 Admin - Gestion du CRUD Mot CLé</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Suppression d'un mot clé</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Mot CLé...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="libMotCle"><b>Nom du mot clé :</b></label>
                            <input class="form-control" type="text" name="libMotCle" id="libMotCle" size="80" maxlength="80" value="<?= $libMotCle ?>" disabled />
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

                        <div class="form-group">
                            <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary" />
                            <input type="submit" value="Valider" name="Submit" class="btn btn-success" />
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

        <?php require_once __DIR__ . '/footerMotCle.php' ?>
    </div>
</main>