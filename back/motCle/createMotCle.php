<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createMotCle.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['libMotCle']) && !empty($_POST['numLang'])) {
        $libMotCle = ctrlSaisies($_POST['libMotCle']);
        $numLang = $_POST['numLang'];

        if (strlen($libMotCle) >= 3) {
            // Ajout effectif de la langue
            $motcle->create($libMotCle, $numLang);

            header('Location: ./motCle.php');
        } else {
            $error = 'La longueur minimale d\'un mot clé est de 3 caractères.';
        }
    } else if (!empty($_POST['Submit']) && $_POST['Submit'] === 'Initialiser') {
        header('Location: ./createMotcle.php');
    } else {
        $error = 'Merci de renseigner tous les champs du formulaire.';
    }
}

$languages = $langue->get_AllLangues();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Mot CLé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- <link href="../css/style.css" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Mot CLé</h1>
            <hr>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <h2>Ajout d'un mot clé</h2>

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

            <?php
            require_once __DIR__ . '/footerMotCle.php';

            require_once __DIR__ . '/footer.php';
            ?>
        </div>
    </main>
</body>

</html>