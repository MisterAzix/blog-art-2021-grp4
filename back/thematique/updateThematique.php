<?php
///////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateThematique.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Thématique';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$thematique = new THEMATIQUE();

// Init variables form
include __DIR__ . '/initThematique.php';
$error = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $result = $thematique->get_1Thematique($_GET['id']);
    $libThem = ctrlSaisies($result->libThem);
    $selectedLang = ctrlSaisies($result->numLang);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['libThem'])) {
            $numThem = ctrlSaisies($_GET['id']);
            $libThem = ctrlSaisies($_POST['libThem']);

            if (strlen($libThem) >= 3) {
                // Modification effective de la thématique
                $thematique->update($numThem, $libThem);

                header('Location: ./thematique.php');
            } else {
                $error = 'La longueur minimale d\'une thématique est de 3 caractères.';
            }
        } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
            header('Location: ./updateThematique.php?id=' . $_GET['id']);
        } else {
            $error = 'Merci de renseigner tous les champs du formulaire.';
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
                <h2>Modification d'une thématique</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Thématique...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="libThem"><b>Nom de la thématique :</b></label>
                            <input class="form-control" type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem ?>" autofocus="autofocus" />
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
            </div>
        </div>

        <?php require_once __DIR__ . '/footerThematique.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>