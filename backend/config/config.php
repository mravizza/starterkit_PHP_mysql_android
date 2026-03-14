<?php
/**
 * Default-Konfiguration
 *
 * NICHT bearbeiten für lokale Einstellungen!
 * Stattdessen config.local.php erstellen (git-ignored).
 */

return [
    // App
    'app_name' => '{{PROJECT_NAME}}',
    'app_url' => 'https://example.com',
    'debug' => false,

    // Database
    'db_host' => 'localhost',
    'db_name' => '{{PROJECT_DB}}',
    'db_user' => 'root',
    'db_pass' => '',

    // API
    'api_version' => '1.0.0',
    'app_registration_key' => 'CHANGE_ME_IN_CONFIG_LOCAL',

    // Security
    'session_lifetime' => 3600, // 1 Stunde
    'rate_limit_requests' => 100,
    'rate_limit_window' => 3600, // pro Stunde

    // Uploads
    'upload_dir' => __DIR__ . '/../uploads/',
    'max_upload_size' => 10 * 1024 * 1024, // 10 MB
    'allowed_mime_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
    ],
];
