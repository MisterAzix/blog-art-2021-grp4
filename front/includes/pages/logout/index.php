<?php
$page_title = 'Login';
$page_description = '';
require_once __DIR__ . '/../../../../CLASS_CRUD/auth.class.php';
$auth = new Auth();
$auth->logout();
header('Location: ../login');