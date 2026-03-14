<?php
/**
 * Helper-Funktionen
 */

/**
 * Redirect zu einer URL
 */
function redirect(string $path): void
{
    header('Location: ' . base_url($path));
    exit;
}

/**
 * Base URL generieren
 */
function base_url(string $path = ''): string
{
    $baseUrl = config('app_url', 'http://localhost:8080');
    return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
}

/**
 * Config-Wert lesen
 */
function config(string $key, $default = null)
{
    return $GLOBALS['config'][$key] ?? $default;
}

/**
 * JSON-Response senden
 */
function json_response(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * HTML-Escape (XSS-Schutz)
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Flash-Message setzen
 */
function flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = $message;
    $_SESSION['flash_type'] = $type;
}

/**
 * Flash-Message abrufen und löschen
 */
function get_flash(): ?array
{
    if (isset($_SESSION['flash'])) {
        $flash = [
            'message' => $_SESSION['flash'],
            'type' => $_SESSION['flash_type'] ?? 'success',
        ];
        unset($_SESSION['flash'], $_SESSION['flash_type']);
        return $flash;
    }
    return null;
}

/**
 * UUID v4 generieren
 */
function uuid_v4(): string
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
