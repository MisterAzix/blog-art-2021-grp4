<?php
///////////////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Code Modifié - 15 Février 2021
//
//  Script  : createLikeCom.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'LikeCom';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/likecom.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
$likecom = new LIKECOM();
$membre = new MEMBRE();
$article = new ARTICLE();
$comment = new COMMENT();

// Init variables form
include __DIR__ . '/initLikeCom.php';
$error = null;

// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['numMemb']) && !empty($_POST['numCom'])) {
        $numMemb = $_POST['numMemb'];
        [$numSeqCom, $numArt] = explode(' ', $_POST['numCom']);

        $likecom->createOrUpdate($numMemb, $numSeqCom, $numArt);
        header('Location: ./likeCom.php');
    } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
        header('Location: ./createLikeCom.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$allMembers = $membre->get_AllMembres();
$allArticles = $article->get_AllArticles();
$allComments = $comment->get_AllComments();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD LikeCom</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'un like sur un commentaire</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="numMemb" value="<?= isset($_GET['numMemb']) ?: '' ?>" />
                    <input type="hidden" name="numSeqCom" value="<?= isset($_GET['numSeqCom']) ?: '' ?>" />
                    <input type="hidden" name="numArt" value="<?= isset($_GET['numArt']) ?: '' ?>" />

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="numMemb"><b>Membre :</b></label>
                            <select name="numMemb" class="form-control" id="numMemb">
                                <option value="">--Choississez un membre--</option>
                                <?php foreach ($allMembers as $member) : ?>
                                    <option value="<?= $member->numMemb ?>"><?= $member->pseudoMemb ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="numCom"><b>Commentaire :</b></label>
                            <select name="numCom" class="form-control" id="numCom">
                                <option value="">--Choississez un commentaire--</option>
                                <?php foreach ($allComments as $comment) : ?>
                                    <option value="<?= $comment->numSeqCom . ' ' . $comment->numArt ?>"><?= $comment->libCom ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary" />
                        <input type="submit" value="Valider" name="Submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerLikeCom.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>