<?php
/**
 * Bootstrap — wird als erstes geladen
 */

// Error Reporting (in Production: E_ALL & ~E_NOTICE)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Session konfigurieren
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.use_strict_mode', 1);

session_start();

// Config laden
$config = require __DIR__ . '/../config/config.php';
$localConfig = __DIR__ . '/../config/config.local.php';
if (file_exists($localConfig)) {
    $config = array_merge($config, require $localConfig);
}
$GLOBALS['config'] = $config;

if ($config['debug']) {
    ini_set('display_errors', 1);
}

// Autoload (einfach, ohne Composer)
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Auth.php';
require_once __DIR__ . '/Csrf.php';
require_once __DIR__ . '/helpers.php';

// Security Headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
