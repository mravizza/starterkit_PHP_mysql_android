<?php
/**
 * Auth — Session + Bearer Token Authentifizierung
 */

class Auth
{
    /**
     * Admin-Session prüfen (Web-UI)
     * Am Anfang jeder Admin-Controller-Methode aufrufen.
     */
    public static function requireAdmin(): void
    {
        if (!isset($_SESSION['admin_user_id'])) {
            redirect('/login');
            exit;
        }
    }

    /**
     * API Bearer Token prüfen
     * Am Anfang jeder API-Controller-Methode aufrufen.
     *
     * @return array Device-Daten
     */
    public static function requireDevice(): array
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!preg_match('/^Bearer\s+([a-f0-9]{64})$/i', $header, $matches)) {
            json_response(['error' => 'Unauthorized'], 401);
            exit;
        }

        $token = $matches[1];
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM devices WHERE api_token = ? AND active = 1');
        $stmt->execute([$token]);
        $device = $stmt->fetch();

        if (!$device) {
            json_response(['error' => 'Unauthorized'], 401);
            exit;
        }

        return $device;
    }

    /**
     * Admin einloggen
     */
    public static function login(string $username, string $password): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM admin_users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            return true;
        }

        return false;
    }

    /**
     * Admin ausloggen
     */
    public static function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }
}
