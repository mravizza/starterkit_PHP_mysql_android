<?php
/**
 * Lokale Konfiguration (git-ignored)
 *
 * Kopiere diese Datei nach config.local.php und passe die Werte an:
 *   cp config.local.example.php config.local.php
 */

return [
    'debug' => true,
    'app_url' => 'http://localhost:8080',

    // Database
    'db_host' => 'localhost',
    'db_name' => 'myproject',
    'db_user' => 'root',
    'db_pass' => '',

    // API
    'app_registration_key' => 'my-secret-registration-key',

    // Optional: externe APIs
    // 'openai_api_key' => 'sk-...',
];
