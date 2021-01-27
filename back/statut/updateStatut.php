<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

$error = null;

// Init variables form
include __DIR__ . '/initStatut.php';

// controle des saisies du formulaire
if (isset($_GET['id'])) {
    // insertion classe STATUT
    require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
    $statut = new STATUT();

    // Ctrl CIR
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    $result = $statut->get_1Statut($_GET['id']);
    $libStat = ctrlSaisies($result->libStat);

    if (isset($_POST['Submit']) && $libStat) {
        if ($_POST['Submit'] === 'Valider') {
            // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
            // modification effective du statut
            $statut->update($_GET['id'], $_POST['libStat']);

            header('Location: ./statut.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>
    <h2>Modification d'un statut</h2>

    <h3><?= $error ?: '' ?></h3>
    <?php
    // Modif : récup id à modifier
    ?>

    <form method="post" action="" enctype="multipart/form-data">

        <fieldset>
            <legend class="legend1">Formulaire Statut...</legend>

            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

            <div class="control-group">
                <label class="control-label" for="libStat"><b>Nom du statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat ?>" autofocus="autofocus" />
            </div>

            <div class="control-group">
                <div class="controls">
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
    require_once __DIR__ . '/footerStatut.php';

    require_once __DIR__ . '/footer.php';
    ?>
</body>

</html>