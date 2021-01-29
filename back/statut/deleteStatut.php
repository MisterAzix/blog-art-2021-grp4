<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

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
        $errCIR = 0;
        switch ($_POST['Submit']) {
            case 'Valider':
                $nbAllUsersByidStat = (int)($user->get_NbAllUsersByidStat($idStat));

                if ($nbAllUsersByidStat < 1) {
                    // Suppression effective du statut
                    $count = $statut->delete($idStat);
                    ($count == 1) ? header('Location: ./statut.php') : die('Erreur delete STATUT !');
                } else {
                    $errCIR = 1;
                    header("Location: ./statut.php?errCIR=$errCIR");
                }
                break;

            case 'Annuler':
                header('Location: ./statut.php');
                break;
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
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }

        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>
    <h2>Suppression d'un statut</h2>

    <h3><?= $error ?: '' ?></h3>

    <form method="post" action="" enctype="multipart/form-data">

        <fieldset>
            <legend class="legend1">Formulaire Statut...</legend>

            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

            <div class="control-group">
                <label class="control-label" for="libStat"><b>Nom du statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat ?>" disabled="disabled" />
            </div>

            <div class="control-group">
                <div class="controls">
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    <br>
    <?php
    require_once __DIR__ . '/footerStatut.php';

    require_once __DIR__ . '/footer.php';
    ?>
</body>

</html>