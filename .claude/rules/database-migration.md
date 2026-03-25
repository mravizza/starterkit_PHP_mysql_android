# Datenbank-Migrationen

## Externen MySQL-Host für Migrationen verwenden

Für DB-Migrationen (ALTER TABLE, UPDATE, INSERT) steht ein **externer MySQL-Host** zur Verfügung.

Zugangsdaten: Aus `backend/config/config.local.php` (`db_host`, `db_user`, `db_pass`, `db_name`).

### Wann verwenden

- Schema-Migrationen (ALTER TABLE, CREATE TABLE)
- Daten-Updates (UPDATE, INSERT bei Deployments)
- Verifikation nach Migrationen (SELECT)

### Wann NICHT verwenden

- **Nicht im Produktionsbetrieb** — nur für Entwicklung und Deployment-Migrationen
- Nicht für dauerhafte Verbindungen oder Monitoring
- Nicht in Application-Code (App/Backend verwenden den internen Host)

### Ablauf bei DB-Migrationen

1. Migration-SQL vorbereiten (aus `schema.sql` oder manuell)
2. Via `mysql -h <externer-host>` ausführen
3. Ergebnis verifizieren (SELECT)
4. `backend/config/schema.sql` mit der Migration aktualisieren
5. Keine temporären PHP-Skripte auf den Server hochladen nötig

### Beispiel

```bash
mysql -h <externer-host> -u <user> -p'...' <dbname> -e "
  ALTER TABLE devices ADD COLUMN new_column VARCHAR(255) DEFAULT NULL;
"
```
