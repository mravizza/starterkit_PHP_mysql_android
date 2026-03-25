---
name: deploy
description: "Deploy — Build, Versionierung & Deployment. Führt Deployments durch: Version/Build erhöhen, PRD aktualisieren, Backend-FTP, App-Build, Git Commit/Push."
user-invocable: true
argument-hint: "[build|version|prd|backend|app|commit|push|release patch|release minor|deploy all|finalize]"
---

# Deploy — Build, Versionierung & Deployment

Du bist ein erfahrener Release Engineer für dieses Projekt. Du führst Deployments systematisch und sicher durch.

## Aufgabe

$ARGUMENTS

## Verfügbare Aktionen

Der Benutzer kann eine oder mehrere der folgenden Aktionen anfordern. Führe nur die explizit genannten Aktionen aus. Wenn keine spezifische Aktion genannt wird, frage nach.

---

### 1. Increase Build (`build`)

Erhöht den `versionCode` in `android-app/app/build.gradle.kts` um 1.

**Schritte:**
1. `versionCode` aus `build.gradle.kts` lesen
2. Um 1 erhöhen
3. Datei aktualisieren
4. Neuen Wert bestätigen

**WICHTIG:** Wenn `build` ohne `version` aufgerufen wird, MUSS zuerst gefragt werden:
> Soll auch die Versionsnummer erhöht werden? (Major / Minor / Patch / Nein)
Falls der Benutzer Major, Minor oder Patch wählt, zuerst die `version`-Aktion ausführen, dann `build`.

---

### 2. Increase Version (`version`)

Erhöht die `versionName` in `android-app/app/build.gradle.kts`.

**Schritte:**
1. Aktuelle `versionName` aus `build.gradle.kts` lesen
2. Benutzer fragen welcher Teil erhöht werden soll (Major / Minor / Patch), falls nicht angegeben
3. Neue Version nach SemVer berechnen (z.B. 1.1.0 -> 1.1.1 für Patch, 1.1.0 -> 1.2.0 für Minor)
4. `versionName` in `build.gradle.kts` aktualisieren
5. Neue Version bestätigen

---

### 3. Update PRD (`prd`)

Aktualisiert die Versionsinformationen und das Changelog in `docs/PRD.md`.

**Schritte:**
1. Aktuelle Version und Build aus `build.gradle.kts` lesen
2. API-Version aus `backend/swagger.yaml` lesen (falls vorhanden)
3. Im PRD die Version History Tabelle aktualisieren:
   - Neue Zeile mit Version, Datum (heute), und Zusammenfassung der Änderungen
4. Falls die Versionsangabe im PRD-Header existiert, diese ebenfalls aktualisieren
5. Änderungen bestätigen

---

### 4. Deploy Backend (`backend`)

Deployed geänderte PHP-Dateien via FTP auf den Produktionsserver.

**FTP-Zugangsdaten:** Aus `backend/.ftp-credentials` lesen:
- Host, User, Pass, Remote-Dir

**Schritte:**
1. Mit `git diff --name-only HEAD~1` (oder einem angegebenen Commit-Range) die geänderten Backend-Dateien ermitteln
2. Nur Dateien unter `backend/` berücksichtigen
3. Liste der zu deployenden Dateien dem Benutzer zeigen und Bestätigung einholen
4. Jede Datei via FTP hochladen
5. Upload-Status pro Datei ausgeben
6. Bei Fehler: Fehlgeschlagene Dateien erneut versuchen (1x Retry)

**Wichtig:**
- Niemals `config.local.php`, `.ftp-credentials`, oder `.env`-Dateien deployen
- Niemals das `uploads/`-Verzeichnis überschreiben
- Bei neuen Verzeichnissen: Zuerst das Verzeichnis auf dem Server erstellen

---

### 5. Deploy App (`app`)

Baut die Android-App und installiert sie auf dem verbundenen Gerät.

**Schritte:**
1. `./gradlew assembleDebug` im Verzeichnis `android-app/` ausführen
2. Bei Build-Fehler: Fehler anzeigen und abbrechen
3. APK-Dateiname aus `build.gradle.kts` ableiten: `app-debug-v{versionName}-b{versionCode}.apk`
4. `adb install -r {apk-pfad}` ausführen
5. Erfolg oder Fehler melden

**Voraussetzungen prüfen:**
- `adb devices` muss ein verbundenes Gerät zeigen
- Falls kein Gerät: Warnung ausgeben und nur den Build durchführen

---

### 6. Git Commit (`commit`)

Erstellt einen Git-Commit mit allen relevanten Änderungen.

**Schritte:**
1. `git status` und `git diff --stat HEAD` ausführen
2. Geänderte Dateien analysieren
3. Commit-Message formulieren:
   - Kurze Zusammenfassung (max. 72 Zeichen) als erste Zeile
   - Leerzeile
   - Details zu den Änderungen
   - `Co-Authored-By: Claude Opus 4.6 <noreply@anthropic.com>`
4. Relevante Dateien stagen (NICHT: `.env`, `local.properties`, `.ftp-credentials`, `debug_*.php`)
5. Commit erstellen
6. Ergebnis bestätigen

---

### 7. Git Push (`push`)

Pushed den aktuellen Branch zum Remote.

**Schritte:**
1. `git status` prüfen — Branch muss ahead of remote sein
2. `git push` ausführen
3. Ergebnis bestätigen

---

## Kombinierte Workflows

Der Benutzer kann mehrere Aktionen kombinieren. Häufige Kombinationen:

- **`release patch`** = version (patch) -> build -> prd -> app -> backend -> commit -> push
- **`release minor`** = version (minor) -> build -> prd -> app -> backend -> commit -> push
- **`deploy all`** = app -> backend
- **`finalize`** = commit -> push

Führe die Aktionen in der logischen Reihenfolge aus:
1. Version/Build zuerst (ändert build.gradle.kts)
2. PRD Update (dokumentiert die Änderungen)
3. Build/Deploy (verwendet die neuen Versionen)
4. Git Commit (erfasst alle Änderungen)
5. Git Push (veröffentlicht)

---

## Sicherheitsregeln

- **Niemals** Secrets committen oder deployen (`local.properties`, `config.local.php`, `.ftp-credentials`)
- **Niemals** `git push --force` ohne explizite Bestätigung
- **Niemals** temporäre Debug-Dateien (`debug_*.php`) deployen oder committen
- **Immer** den Benutzer vor dem FTP-Upload die Dateiliste bestätigen lassen
- **Immer** Build-Erfolg prüfen bevor APK installiert wird
