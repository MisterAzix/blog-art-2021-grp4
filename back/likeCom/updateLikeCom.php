<?php
///////////////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Code Modifié - 12 Février 2021
//
//  Script  : createLikeCom.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/likecom.class.php';
$likecom = new LIKECOM();

// Init variables form
include __DIR__ . '/initLikeCom.php';
$error = null;

// Controle des saisies du formulaire
if (isset($_GET['numMemb']) && isset($_GET['numSeqCom']) && isset($_GET['numArt'])) {
    $numMemb = $_GET['numMemb'];
    $numSeqCom = $_GET['numSeqCom'];
    $numArt = $_GET['numArt'];
    $result = $likecom->get_1LikeCom($numMemb, $numSeqCom, $numArt);
    if ($result) $likecom->createOrUpdate($numMemb, $numSeqCom, $numArt);
}
header('Location: ./likeCom.php');
?>