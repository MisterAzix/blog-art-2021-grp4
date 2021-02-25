<?php
/////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : thematique.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Thématique';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ANGLE
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$thematiques = new THEMATIQUE();

// Appel méthode : tous les angles en BDD
$all = $thematiques->get_AllThematiques();

require_once __DIR__ . '/../common/header.php';
?>

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
                    <th>Langue</th>
                    <th>Libellé</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $row) : ?>
                    <tr>
                        <td>
                            <h4> <?= $row->numThem ?> </h4>
                        </td>
                        <td> <?= $row->numLang ?> </td>
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
<?php require_once __DIR__ . '/../common/footer.php' ?>