<?php
require_once __DIR__ . '../../../CLASS_CRUD/likeart.class.php';
require_once __DIR__ . '../../../CLASS_CRUD/likecom.class.php';
require_once __DIR__ . '../../../CLASS_CRUD/auth.class.php';
$likeart = new LIKEART;
$likecom = new LIKECOM;
$auth = new AUTH;

$connectedMemb = $auth->get_connected_id();
if (!$connectedMemb) die('notConnected');

if (!empty($_POST['numSeqCom']) && !empty($_POST['numArt'])) {
    $oui = $likecom->createOrUpdate($connectedMemb, $_POST['numSeqCom'], $_POST['numArt']);
    $result = $likecom->get_AllLikesComByComment($_POST['numSeqCom'], $_POST['numArt']);
} else if (!empty($_POST['numArt'])) {
    $likeart->createOrUpdate($connectedMemb, $_POST['numArt']);
    $result = $likeart->get_AllLikesArtByArticle($_POST['numArt']);
}

echo count($result);
