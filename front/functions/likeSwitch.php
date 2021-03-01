<?php
require_once __DIR__ . '../../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '../../../CLASS_CRUD/auth.class.php';
$likeart = new LIKEART;
$auth = new AUTH;
$likes = null;

if (!empty($_POST['numArt'])) {
    $connectedMemb = $auth->get_connected_id();
    if (!$connectedMemb) die('notConnected');
    $likeart->createOrUpdate($connectedMemb, $_POST['numArt']);
    $result = $likeart->get_AllLikesArtByArticle($_POST['numArt']);
}

echo count($result);