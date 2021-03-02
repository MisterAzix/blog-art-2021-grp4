<?php
$config = null;
$path = __DIR__ . '/config.json';
if (file_exists($path)) $config = json_decode(file_get_contents($path));

$configData = new stdClass();
$configData->CAPTCHA_SITE_KEY = $config ? $config->CAPTCHA_SITE_KEY : getenv('CAPTCHA_SITE_KEY');
$configData->CAPTCHA_SECRET_KEY = $config ? $config->CAPTCHA_SECRET_KEY : getenv('CAPTCHA_SECRET_KEY');
$configData->DB_HOSTNAME = $config ? $config->DB_HOSTNAME : getenv('DB_HOSTNAME');
$configData->DB_NAME = $config ? $config->DB_NAME : getenv('DB_NAME');
$configData->DB_USER = $config ? $config->DB_USER : getenv('DB_USER');
$configData->DB_PASSWORD = $config ? $config->DB_PASSWORD : getenv('DB_PASSWORD');
