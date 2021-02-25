<?php
//========================================//
//
//                404.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = '404';
$page_description = '404 not found!';

require_once __DIR__ . '../../../commons/header.php';
?>

<main class="error-container">
    <h1>Erreur 404 : Page introuvable !</h1>
</main>

<?php require_once __DIR__ . '../../../commons/footer.php' ?>