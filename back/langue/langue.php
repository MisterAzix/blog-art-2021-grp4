<?php
/////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : langue.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Langue';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe LANGUE
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();

// Appel méthode : toutes les langues en BDD
$all = $langue->get_AllLangues();

require_once __DIR__ . '/../common/header.php';
?>

<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
        <hr>
        <h2>Nouvelle langue : <a href="./createLangue.php"><i>Create a language</i></a></h2>
        <hr>
        <h2>Tous les statuts</h2>

        <table class="table table-striped">
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
    </div>
</main>
<?php require_once __DIR__ . '/../common/footer.php' ?>