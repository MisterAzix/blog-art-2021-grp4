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

require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();
$all = $langue->get_AllLangues();
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
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
            <hr>
            <h2>Nouvelle langue : <a href="./createLangue.php"><i>Create a language</i></a></h2>
            <hr>
            <h2>Tous les statuts</h2>

            <table border="3" bgcolor="aliceblue">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Nom</th>
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
                            <td> <?= $row->lib1Lang; ?> </td>
                            <td> <?= $row->lib2Lang; ?> </td>
                            <td><a href="./updateLangue.php?id=<?= $row->numLang ?>"><i>Modifier</i></a>
                                <br>
                            </td>
                            <td><a href="./deleteLangue.php?id=<?= $row->numLang ?>"><i>Supprimer</i></a>
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