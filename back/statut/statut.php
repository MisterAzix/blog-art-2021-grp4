<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : statut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Récupération des codes d'erreurs
$errCIR = isset($_GET['errCIR']) ?: null;

// Insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$statut = new STATUT();

// Appel méthode : tous les statuts en BDD
$all = $statut->get_AllStatuts();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion du Statut</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>

            <hr /><br />
            <h2>Nouveau statut : <a href="./createStatut.php"><i>Créer un statut</i></a></h2>
            <br />
            <hr />
            <h2>Tous les statuts</h2>

            <table border="3" bgcolor="aliceblue">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Boucle pour afficher
                    foreach ($all as $row) :
                    ?>
                        <tr>
                            <td>
                                <h4> <?= $row->idStat; ?> </h4>
                            </td>

                            <td> <?= $row->libStat; ?> </td>

                            <td><a href="./updateStatut.php?id=<?= $row->idStat ?>"><i>Modifier</i></a>
                                <br />
                            </td>
                            <td><a href="./deleteStatut.php?id=<?= $row->idStat ?>"><i>Supprimer</i></a>
                                <br />
                            </td>
                        </tr>
                    <?php
                    endforeach; // End of foreach 
                    ?>
                </tbody>
            </table>
            <?php if ($errCIR == 1) : ?>
                <i>
                    <div class="error">=> Suppression impossible, existence de user(s) associé(s) à ce statut. Vous devez d'abord supprimer le(s) user(s) concerné(s)</div>
                </i>
            <?php endif ?>

            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>