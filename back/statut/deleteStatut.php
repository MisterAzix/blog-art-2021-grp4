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
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
$statut = new STATUT();
$membre = new MEMBRE();

// Init variables form
include __DIR__ . '/initStatut.php';
$error = null;
$members = null;

// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $idStat = $_GET['id'];
    $result = $statut->get_1Statut($idStat);
    if (!$result) header('Location: ./statut.php');
    $libStat = ctrlSaisies($result->libStat);

    if (isset($_POST['Submit'])) {
        switch ($_POST['Submit']) {
            case 'Supprimer':
                $members = $membre->get_AllMembresByStatut($idStat);

                if (!$members) {
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

                    <div class="form-group mb-3">
                        <input type="submit" value="Annuler" name="Submit" class="btn btn-primary" />
                        <input type="submit" value="Supprimer" name="Submit" class="btn btn-danger" />
                    </div>
                </form>

                <?php if ($members) : ?>
                    <h4>Membre<?= (count($members) > 1) ? 's' : '' ?> à supprimer :</h4>
                    <ul>
                        <?php foreach ($members as $member) : ?>
                            <li><b><?= $member->numMemb ?> :</b> <?= $member->pseudoMemb ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>

            </div>
        </div>

        <?php require_once __DIR__ . '/footerStatut.php' ?>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>