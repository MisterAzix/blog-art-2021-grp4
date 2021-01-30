<?php
///////////////////////////////////////////////////////////////
//
//  Méthodes fournies - 23 Janvier 2021
//  Récupérer la prochaine PK de la table MOTCLE
//
//  Script : getNextnumMotCle.php   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../util/utilErrOn.php';

function getNextnumMotCle($numLang)
{

    global $db;

    // Découpage FK LANGUE
    $libLangSelect = substr($numLang, 0, 4);
    $parmNumLang = $libLangSelect . '%';

    $requete = "SELECT MAX(numLang) AS numLang FROM MOTCLE WHERE numLang LIKE '$parmNumLang';";
    $result = $db->query($requete);

    if ($result) {
        $tuple = $result->fetch();
        $numLang = $tuple["numLang"];
        if (is_null($numLang)) {    // New lang dans MOTCLE
            // Récup dernière PK utilisée
            $requete = "SELECT MAX(numMotCle) AS numMotCle FROM MOTCLE;";
            $result = $db->query($requete);
            $tuple = $result->fetch();
            $numMotCle = $tuple["numMotCle"];

            $numMotCleSelect = (int)substr($numMotCle, 4, 2);
            // No séquence suivant LANGUE
            $numSeq1MoCle = $numMotCleSelect + 1;
            // Init no séquence MOTCLE pour nouvelle lang
            $numSeq2MoCle = 1;
        } else {
            // Récup dernière PK pour FK sélectionnée
            $requete = "SELECT MAX(numMotCle) AS numMotCle FROM MOTCLE WHERE numLang LIKE '$parmNumLang' ;";
            $result = $db->query($requete);
            $tuple = $result->fetch();
            $numMotCle = $tuple["numMotCle"];

            // No séquence actuel LANGUE
            $numSeq1MoCle = (int)substr($numMotCle, 4, 2);
            // No séquence actuel MOTCLE
            $numSeq2MoCle = (int)substr($numMotCle, 6, 2);
            // No séquence suivant MOTCLE
            $numSeq2MoCle++;
        }

        $libMoCleSelect = "MTCL";
        // PK reconstituée : MTCL + no seq langue
        if ($numSeq1MoCle < 10) {
            $numMotCle = $libMoCleSelect . "0" . $numSeq1MoCle;
        } else {
            $numMotCle = $libMoCleSelect . $numSeq1MoCle;
        }
        // PK reconstituée : MOCL + no seq langue + no seq mot clé
        if ($numSeq2MoCle < 10) {
            $numMotCle = $numMotCle . "0" . $numSeq2MoCle;
        } else {
            $numMotCle = $numMotCle . $numSeq2MoCle;
        }
    }   // End of if ($result) / no seq LANGUE
    return $numMotCle;
} // End of function
