<?php
/////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : motCle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ANGLE
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
$motcles = new MOTCLE();

// Appel méthode : tous les angles en BDD
$all = $motcles->get_AllMotsCles();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Mot-Clé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Mot-Clé</h1>
            <hr>
            <h2>Nouveau Mot-Clé : <a href="./createMotCle.php"><i>Create a keyword</i></a></h2>
            <hr>
            <h2>Tous les Mots-Clés</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Langue</th>
                        <th>Libellé</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $row) : ?>
                        <tr>
                            <td>
                                <h4> <?= $row->numMotCle ?> </h4>
                            </td>
                            <td> <?= $row->numLang ?> </td>
                            <td> <?= $row->libMotCle ?> </td>
                            <td><a href="./updateMotCle.php?id=<?= $row->numMotCle ?>"><i>Modifier</i></a>
                                <br>
                            </td>
                            <td><a href="./deleteMotCle.php?id=<?= $row->numMotCle ?>"><i>Supprimer</i></a>
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