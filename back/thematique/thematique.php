<?php
/////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : thematique.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ANGLE
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$thematiques = new THEMATIQUE();

// Appel méthode : tous les angles en BDD
$all = $thematiques->get_AllThematiques();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Thématique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Thématique</h1>
            <hr>
            <h2>Nouvelle Thématique : <a href="./createThematique.php"><i>Create a thematic</i></a></h2>
            <hr>
            <h2>Toutes les Thématiques</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Libellé</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $row) : ?>
                        <tr>
                            <td>
                                <h4> <?= $row->numLang ?> </h4>
                            </td>
                            <td> <?= $row->libThem ?> </td>
                            <td><a href="./updateThematique.php?id=<?= $row->numThem ?>"><i>Modifier</i></a>
                                <br>
                            </td>
                            <td><a href="./deleteThematique.php?id=<?= $row->numThem ?>"><i>Supprimer</i></a>
                                <br>
                            </td>
                        </tr>
                    <?php endforeach  ?>
                </tbody>
            </table>

            <?php require_once __DIR__ . '/footer.php' ?>
        </div>
    </main>
</body>

</html>