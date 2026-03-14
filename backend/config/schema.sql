-- ========================================
-- Database Schema: {{PROJECT_NAME}}
-- ========================================
-- Naming: snake_case für Tabellen und Spalten
-- Migrations: Als ALTER-Statements am Ende anhängen

-- ──────────────────────────────────────────
-- Admin Users
-- ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Admin (Passwort in config.local.php ändern!)
-- INSERT INTO admin_users (username, password_hash) VALUES ('admin', '$2y$10$...');

-- ──────────────────────────────────────────
-- Devices (API-Clients)
-- ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id VARCHAR(36) NOT NULL UNIQUE,
    name VARCHAR(255) DEFAULT '',
    api_token VARCHAR(64) NOT NULL UNIQUE,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────
-- TODO: Weitere Tabellen hier ergänzen
-- ──────────────────────────────────────────


-- ========================================
-- Migrations (ALTER-Statements hier anhängen)
-- ========================================
-- Beispiel:
-- ALTER TABLE devices ADD COLUMN last_seen_at TIMESTAMP NULL;
