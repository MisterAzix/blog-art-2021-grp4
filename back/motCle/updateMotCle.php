<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateMotCle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Mot Clé';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
$motcle = new MOTCLE();

// Init variables form
include __DIR__ . '/initMotCle.php';
$error = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $result = $motcle->get_1MotCle($_GET['id']);
    $libMotCle = ctrlSaisies($result->libMotCle);
    $selectedLang = ctrlSaisies($result->numLang);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['submit']) && $_POST['submit'] === 'Modifier' && !empty($_POST['libMotCle'])) {
            $numMotCle = $_GET['id'];
            $libMotCle = $_POST['libMotCle'];

            if (strlen($libMotCle) >= 3) {
                // Modification effective du mot clé
                $motcle->update($numMotCle, $libMotCle);

                header('Location: ./motCle.php');
            } else {
                $error = 'La longueur minimale d\'un mot clé est de 3 caractères.';
            }
        } else if (!empty($_POST['submit']) && $_POST['submit'] === 'Initialiser') {
            header('Location: ./updateMotCle.php?id=' . $_GET['id']);
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
        <h1>BLOGART21 Admin - Gestion du CRUD Mot CLé</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Modification d'un mot clé</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Mot CLé...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="libMotCle"><b>Nom du mot clé :</b></label>
                            <input class="form-control" type="text" name="libMotCle" id="libMotCle" size="80" maxlength="80" value="<?= $libMotCle ?>" autofocus="autofocus" />
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
                            <input type="submit" value="Initialiser" name="submit" class="btn btn-primary" />
                            <input type="submit" value="Modifier" name="submit" class="btn btn-success" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerMotCle.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>