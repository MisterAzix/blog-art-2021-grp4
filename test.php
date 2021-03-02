<?php
$path = __DIR__ . '/config.jso';
$configData = file_exists ($path) ? json_decode(file_get_contents($path)) : new stdClass();
$configData->DB_USER = 'OUI';
print_r($configData);