<?php
/////////////////////////////////////////////////////
//
//  CRUD USER (PDO) - Modifié - 11 Février 2021
//
//  Script  : user.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe USER
require_once __DIR__ . '/../../CLASS_CRUD/user.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$user = new USER();
$statut = new STATUT();

// Appel méthode : tous les users en BDD
$all = $user->get_AllUsers();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="d-flex flex-column">
            <h1>BLOGART21 Admin - Gestion du CRUD User</h1>
            <hr>
            <h2>Nouveau user : <a href="./createUser.php"><i>Create a user</i></a></h2>
            <hr>
            <h2>Tous les user</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $row) : ?>
                        <tr>
                            <td>
                                <h4> <?= $row->pseudoUser ?> </h4>
                            </td>
                            <td> <?= $row->nomUser ?> </td>
                            <td> <?= $row->prenomMemb ?> </td>
                            <td> <?= $row->eMailUser ?> </td>
                            <td> <?= $statut->get_1Statut($row->idStat)->libStat ?> </td>
                            <td><a href="./updateUser.php?id=<?= $row->pseudoUser ?>"><i>Modifier</i></a>
                                <br>
                            </td>
                            <td><a href="./deleteUser.php?id=<?= $row->pseudoUser ?>"><i>Supprimer</i></a>
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