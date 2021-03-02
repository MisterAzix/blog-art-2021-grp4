<?php
/////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié - 10 Février 2021
//
//  Script  : membre.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Membre';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe MEMBRE
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$membre = new MEMBRE();
$statut = new STATUT();

// Appel méthode : tous les membres en BDD
$all = $membre->get_AllMembres();
$allStatus = $statut->get_AllStatuts();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>
        <hr>
        <h2>Nouveau membre : <a href="./createMembre.php"><i>Create a member</i></a></h2>
        <hr>
        <h2>Tous les membres</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $row) : ?>
                    <tr>
                        <td>
                            <h4> <?= $row->numMemb ?> </h4>
                        </td>
                        <td> <?= $row->prenomMemb; ?> </td>
                        <td> <?= $row->nomMemb; ?> </td>
                        <td> <?= $row->pseudoMemb; ?> </td>
                        <td> <?= $row->eMailMemb; ?> </td>
                        <td> <?= $allStatus[array_search($row->idStat, array_column($allStatus, 'idStat'))]->libStat ?> </td>
                        <td> <?= $row->dtCreaMemb; ?> </td>
                        <td><a href="./updateMembre.php?id=<?= $row->numMemb ?>"><i>Modifier</i></a>
                            <br>
                        </td>
                        <td><a href="./deleteMembre.php?id=<?= $row->numMemb ?>"><i>Supprimer</i></a>
                            <br>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>