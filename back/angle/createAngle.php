<?php
///////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createAngle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Angle';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
$angle = new ANGLE();

// Init variables form
include __DIR__ . '/initAngle.php';
$error = null;


// Controle des saisies du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['libAngl']) && !empty($_POST['numLang'])) {
        $libAngl = ctrlSaisies($_POST['libAngl']);
        $numLang = $_POST['numLang'];

        if (strlen($libAngl) >= 3) {
            // Ajout effectif de la langue
            $angle->create($libAngl, $numLang);

            header('Location: ./angle.php');
        } else {
            $error = 'La longueur minimale d\'un angle est de 5 caractères.';
        }
    } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
        header('Location: ./createAngle.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$languages = $langue->get_AllLangues();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Ajout d'un angle</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Angle...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="form-group mb-3">
                            <label for="libAngl"><b>Nom de l'angle :</b></label>
                            <input class="form-control" type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl ?>" autofocus="autofocus" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="numLang"><b>Langues :</b></label>
                            <select name="numLang" class="form-control" id="numLang">
                                <option value="">--Choississez une langue--</option>
                                <?php foreach ($languages as $language) : ?>
                                    <option value="<?= $language->numLang ?>"><?= $language->lib1Lang ?></option>
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
        <?php require_once __DIR__ . '/footerAngle.php' ?>
    </div>
</main>

<?php require_once __DIR__ . '/../common/footer.php' ?>