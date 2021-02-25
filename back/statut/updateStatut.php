<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Statut';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$statut = new STATUT();

// Init variables form
include __DIR__ . '/initStatut.php';
$error = null;

// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $result = $statut->get_1Statut($_GET['id']);
    $libStat = ctrlSaisies($result->libStat);

    if (isset($_POST['Submit']) && $libStat) {
        if ($_POST['Submit'] === 'Modifier') {
            // Modification effective du statut
            $statut->update($_GET['id'], $_POST['libStat']);

            header('Location: ./statut.php');
        }
    }
}

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Modification d'un statut</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                    <div class="form-group mb-3">
                        <label for="libStat"><b>Nom du statut :</b></label>
                        <input class="form-control" type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat ?>" autofocus="autofocus" />
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Initialiser" name="submit" class="btn btn-primary" />
                        <input type="submit" value="Modifier" name="submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerStatut.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>