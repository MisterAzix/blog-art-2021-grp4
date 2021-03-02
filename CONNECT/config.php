<?php
$config = file_get_contents(__DIR__ . '/../config.json');
$configData = json_decode($config);

// nom de votre serveur (ou 127.0.0.1)
$hostBD = $configData->DB_HOSTNAME;
// nom BD
$nomBD = $configData->DB_NAME;
// Serveur
// Avec encodage UTF8
$serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";
// nom utilisateur de connexion à la BDD
$userBD = $configData->DB_USER;   // Votre login
// mot de passe de connexion à la BDD
$passBD = $configData->DB_PASSWORD;       // Votre Pass
