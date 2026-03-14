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

---

### 2. Increase Version (`version`)

Erhöht die `versionName` in `android-app/app/build.gradle.kts`.

**Schritte:**
1. Aktuelle `versionName` lesen
2. Benutzer fragen welcher Teil erhöht werden soll (Major / Minor / Patch), falls nicht angegeben
3. Neue Version nach SemVer berechnen
4. `versionName` aktualisieren
5. Neue Version bestätigen

---

### 3. Update PRD (`prd`)

Aktualisiert die Versionsinformationen und das Changelog in `docs/PRD.md`.

**Schritte:**
1. Aktuelle Version und Build aus `build.gradle.kts` lesen
2. Im PRD die Version History Tabelle aktualisieren
3. Änderungen bestätigen

---

### 4. Deploy Backend (`backend`)

Deployed geänderte PHP-Dateien via FTP auf den Produktionsserver.

**FTP-Zugangsdaten:** Aus `backend/.ftp-credentials` lesen.

**Schritte:**
1. Mit `git diff --name-only HEAD~1` die geänderten Backend-Dateien ermitteln
2. Liste dem Benutzer zeigen und Bestätigung einholen
3. Jede Datei via FTP hochladen
4. Upload-Status pro Datei ausgeben

**Wichtig:**
- Niemals `config.local.php`, `.ftp-credentials`, oder `.env`-Dateien deployen
- Niemals das `uploads/`-Verzeichnis überschreiben

---

### 5. Deploy App (`app`)

Baut die Android-App und installiert sie auf dem verbundenen Gerät.

**Schritte:**
1. `./gradlew assembleDebug` im Verzeichnis `android-app/` ausführen
2. Bei Build-Fehler: Fehler anzeigen und abbrechen
3. APK-Pfad ermitteln
4. `adb install -r {apk-pfad}` ausführen

---

### 6. Git Commit (`commit`)

Erstellt einen Git-Commit mit allen relevanten Änderungen.

**Schritte:**
1. `git status` und `git diff --stat HEAD` ausführen
2. Geänderte Dateien analysieren
3. Commit-Message formulieren (max. 72 Zeichen erste Zeile)
4. Relevante Dateien stagen (NICHT: `.env`, `local.properties`, `.ftp-credentials`)
5. Commit mit Co-Author Tag erstellen

---

### 7. Git Push (`push`)

Pushed den aktuellen Branch zum Remote.

---

## Kombinierte Workflows

- **`release patch`** = version (patch) → build → prd → app → backend → commit → push
- **`release minor`** = version (minor) → build → prd → app → backend → commit → push
- **`deploy all`** = app → backend
- **`finalize`** = commit → push

## Sicherheitsregeln

- **Niemals** Secrets committen oder deployen
- **Niemals** `git push --force` ohne explizite Bestätigung
- **Niemals** temporäre Debug-Dateien deployen oder committen
- **Immer** den Benutzer vor dem FTP-Upload die Dateiliste bestätigen lassen
- **Immer** Build-Erfolg prüfen bevor APK installiert wird
