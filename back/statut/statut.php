<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : statut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Statut';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Récupération des codes d'erreurs
$errCIR = isset($_GET['errCIR']) ?: null;

// Insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
$statut = new STATUT();

// Appel méthode : tous les statuts en BDD
$all = $statut->get_AllStatuts();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>

        <hr /><br />
        <h2>Nouveau statut : <a href="./createStatut.php"><i>Créer un statut</i></a></h2>
        <br />
        <hr />
        <h2>Tous les statuts</h2>

        <table class="table table-striped">
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
                        <td><a href="./updateStatut.php?id=<?= $row->idStat ?>"><i>Modifier</i></a></td>
                        <td><a href="./deleteStatut.php?id=<?= $row->idStat ?>"><i>Supprimer</i></a></td>
                    </tr>
                <?php
                endforeach; // End of foreach 
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>