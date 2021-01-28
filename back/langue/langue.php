<?php
/////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : langue.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
    <hr>
    <h2>Tous les statuts</h2>
    <hr>

    <main class="container">
        <div class="d-flex flex-column">
            <table border="3" bgcolor="aliceblue">
                <thead>
                    <tr>
                        <th>&nbsp;Numéro&nbsp;</th>
                        <th>&nbsp;Nom&nbsp;</th>
                        <th colspan="2">&nbsp;Action&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Boucle pour afficher
                    foreach ($all as $row) :
                    ?>
                        <tr>
                            <td>
                                <h4>&nbsp; <?= $row->idStat; ?> &nbsp;</h4>
                            </td>

                            <td>&nbsp; <?= $row->libStat; ?> &nbsp;</td>

                            <td>&nbsp;<a href="./updateStatut.php?id=<?= $row->idStat ?>"><i>Modifier</i></a>&nbsp;
                                <br />
                            </td>
                            <td>&nbsp;<a href="./deleteStatut.php?id=<?= $row->idStat ?>"><i>Supprimer</i></a>&nbsp;
                                <br />
                            </td>
                        </tr>
                    <?php
                    endforeach; // End of foreach 
                    ?>
                </tbody>
            </table>
            
            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>