<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Statut';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$statut = new STATUT();
require_once __DIR__ . '/../../CLASS_CRUD/user.class.php';
$user = new USER();

// Init variables form
include __DIR__ . '/initStatut.php';
$error = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $idStat = ctrlSaisies($_GET['id']);
    $result = $statut->get_1Statut($idStat);
    if (!$result) header('Location: ./statut.php');
    $libStat = ctrlSaisies($result->libStat);

    if (isset($_POST['Submit'])) {
        switch ($_POST['Submit']) {
            case 'Valider':
                $nbAllUsersByidStat = (int)($user->get_NbAllUsersByidStat($idStat));

                if ($nbAllUsersByidStat < 1) {
                    // Suppression effective du statut
                    $count = $statut->delete($idStat);
                    ($count == 1) ? header('Location: ./statut.php') : die('Erreur delete STATUT !');
                } else {
                    $error = "Suppression impossible, existence de user(s) associé(s) à ce statut. Vous devez d'abord supprimer le(s) user(s) concerné(s)";
                }
                break;

            case 'Annuler':
                header('Location: ./statut.php');
                break;
        }
    }
}

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>


        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Suppression d'un statut</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                    <div class="form-group mb-3">
                        <label class="control-label" for="libStat"><b>Nom du statut :</b></label>
                        <input class="form-control" type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat ?>" disabled="disabled" />
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Initialiser" name="Submit" class="btn btn-primary" />
                        <input type="submit" value="Valider" name="Submit" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>

        <?php require_once __DIR__ . '/footerStatut.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>