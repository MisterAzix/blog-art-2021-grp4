<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MOTCLEART (PDO) - Code Modifié - 12 Février 2021
//
//  Script  : updateMotCleArt.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Mots Clés Article';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
$motclearticle = new MOTCLEARTICLE();
$motcle = new MOTCLE();
$article = new ARTICLE();

// Init variables form
include __DIR__ . '/initMotCleArticle.php';
$error = null;

if (isset($_GET['numArt'])) {
    $result = $motclearticle->get_AllMotCleArtByArticle($_GET['numArt']);
    if (!$result) header('Location: ./motCleArticle.php');
    foreach ($result as $value) {
        $selectedKeywords[] = $value->numMotCle;
    }

    //var_dump($_POST['numMotCle']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            !empty($_POST['submit']) && $_POST['submit'] === 'Modifier' &&
            !empty($_POST['numMotCle']) && count($_POST['numMotCle']) > 0
        ) {
            $numArt = ctrlSaisies($_GET['numArt']);
            $keywordToAdd = array_diff($_POST['numMotCle'], $selectedKeywords);
            $keywordToDel = array_diff($selectedKeywords, $_POST['numMotCle']);

            foreach ($keywordToAdd as $numMotCle) {
                $motclearticle->create($numArt, $numMotCle);
            }
            foreach ($keywordToDel as $numMotCle) {
                $motclearticle->delete($numArt, $numMotCle);
            }
            header('Location: ./motCleArticle.php');
        } else if (!empty($_POST['submit']) && $_POST['submit'] === 'Initialiser') {
            header('Location: ./updateMotCleArt.php?numArt=' . $_GET['numArt']);
        } else {
            $error = 'Merci de renseigner tous les champs du formulaire.';
        }
    }
}

$allMotsCles = $motcle->get_AllMotsCles();
$allArticles = $article->get_AllArticles();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD MotCleArticle</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'un mot-clé sur un article</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="numArt" value="<?= isset($_GET['numArt']) ?: '' ?>" />

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="numArt"><b>Article :</b></label>
                            <select name="numArt" class="form-control" disabled>
                                <option value="">--Choississez un article--</option>
                                <?php foreach ($allArticles as $article) : ?>
                                    <option value="<?= $article->numArt ?>" <?= ($article->numArt === $_GET['numArt']) ? 'selected' : '' ?>><?= $article->libTitrArt ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="numMotCle[]"><b>Mots-Clés :</b></label>
                            <select name="numMotCle[]" class="form-control" multiple>
                                <option value="">--Choississez un ou plusieurs mot(s)-clé(s)--</option>
                                <?php foreach ($allMotsCles as $motcle) : ?>
                                    <option value="<?= $motcle->numMotCle ?>" <?= in_array($motcle->numMotCle, $selectedKeywords) ? 'selected' : '' ?>><?= $motcle->libMotCle ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Initialiser" name="submit" class="btn btn-primary" />
                        <input type="submit" value="Modifier" name="submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerMotCleArticle.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>