<?php
/**
 * CSRF — Token-basierte Validierung
 */

class Csrf
{
    /**
     * CSRF-Token generieren (falls noch keines existiert)
     */
    public static function token(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Hidden Input für Formulare
     */
    public static function field(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(self::token()) . '">';
    }

    /**
     * CSRF-Token validieren
     * In jedem POST-Handler aufrufen.
     */
    public static function validate(): void
    {
        $token = $_POST['csrf_token'] ?? '';

        if (!hash_equals(self::token(), $token)) {
            http_response_code(403);
            die('CSRF-Token ungültig. Bitte Seite neu laden.');
        }

        // Token nach Validierung erneuern
        unset($_SESSION['csrf_token']);
    }
}
