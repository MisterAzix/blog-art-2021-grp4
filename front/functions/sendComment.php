<?php
require_once __DIR__ . '../../../CLASS_CRUD/comment.class.php';
require_once __DIR__ . '../../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '../../../CLASS_CRUD/auth.class.php';
$comment = new COMMENT;
$membre = new MEMBRE;
$auth = new AUTH;

$com = null;

$connectedMemb = $auth->get_connected_id();
if (!$connectedMemb) die('notConnected');

if (isset($_POST['numArt']) && isset($_POST['libCom'])) {
    $com = $comment->create($_POST['numArt'], $_POST['libCom'], $connectedMemb);
}

if (!$com) die('cannotPost');
$memb = $membre->get_1Membre($com->numMemb);

require __DIR__ . '/../includes/components/comment.php';
?>
<div class="separator"><span></span></div>
