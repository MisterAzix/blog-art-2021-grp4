<?php
$page_title = 'Deconnexion';
$page_description = "Ce n'est qu'une simple page de deconnexion, tu ne resteras jamais ici bien longtemps.";
require_once __DIR__ . '/../../../CLASS_CRUD/auth.class.php';
$auth = new Auth();
$auth->logout();
header('Location: ./connexion');