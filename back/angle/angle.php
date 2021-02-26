<?php
/////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : angle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Angle';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ANGLE
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
$angles = new ANGLE();

// Appel méthode : tous les angles en BDD
$all = $angles->get_AllAngles();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
        <hr>
        <h2>Nouvel angle : <a href="./createAngle.php"><i>Create a perspective</i></a></h2>
        <hr>
        <h2>Tous les angles</h2>

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
                            <h4> <?= $row->numAngl ?> </h4>
                        </td>
                        <td> <?= $row->numLang ?> </td>
                        <td> <?= $row->libAngl ?> </td>
                        <td><a href="./updateAngle.php?id=<?= $row->numAngl ?>"><i>Modifier</i></a>
                            <br>
                        </td>
                        <td><a href="./deleteAngle.php?id=<?= $row->numAngl ?>"><i>Supprimer</i></a>
                            <br>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>