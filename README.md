# Starterkit: PHP + MySQL + Android

Ein **Claude Code Starterkit** für Projekte mit PHP-Backend und Android-App. Enthält bewährte Konfigurationen, Skills, Hooks und Dokumentationsstrukturen.

## Was ist enthalten?

### Claude Code Konfiguration (`.claude/`)

| Bereich | Dateien | Beschreibung |
|---------|---------|-------------|
| **Rules** | `.claude/rules/` | Clean Code, Feature-Docs, Release-Naming, Skill-Pipeline |
| **Hooks** | `.claude/hooks/` | Sensitive-File-Schutz, Destruktive-Befehle-Blocker, Schema-Guard, Feature-Docs-Reminder, Compact-Context, Windows-Notification |
| **Skills** | `.claude/commands/` | 9 spezialisierte Skills (Architect, Backend, Frontend, Deploy, QA, Pentest, Requirements, UX-Review, User-Journeys) |
| **Settings** | `.claude/settings.json` | Hooks-Konfiguration, Plugin-Platzhalter |

### Dokumentationsstruktur (`docs/`)

| Bereich | Dateien | Beschreibung |
|---------|---------|-------------|
| **PRD** | `docs/PRD.md` | Product Requirements Document (Architektur, NFR, Versionshistorie) |
| **Roadmap** | `docs/Roadmap.md` | Produkt-Roadmap (getrennt von PRD für besseren Context) |
| **Features** | `docs/features/` | Feature-Spezifikationen mit User Stories und Akzeptanzkriterien |
| **QA-Reports** | `docs/qa-check/` | QA-Berichte pro Version |
| **Pentest-Reports** | `docs/pentest/` | Security-Berichte pro Version |

### CI/CD (`.github/workflows/`)

| Workflow | Beschreibung |
|----------|-------------|
| `ci.yml` | Lint + Test bei Push/PR |

### Projekt-Skelett

```
backend/           — PHP Backend (Vanilla PHP + MySQL)
android-app/       — Android App (Kotlin + Compose)
release/           — Archivierte Release-Artefakte
```

## Setup-Anleitung

### 1. Template kopieren

```bash
# Neues Projekt erstellen
cp -r starterkit_PHP_mysql_android/ mein-neues-projekt/
cd mein-neues-projekt/
git init
```

### 2. Platzhalter ersetzen

Suche und ersetze in allen Dateien:
- `{{PROJECT_NAME}}` → Dein Projektname
- `{{APP_PACKAGE}}` → Android Package (z.B. `com.example.myapp`)
- `{{BACKEND_URL}}` → Backend-URL (z.B. `https://api.example.com`)
- `{{FTP_HOST}}` → FTP-Server (z.B. `ftp.example.com`)

### 3. Lokale Konfiguration

```bash
# Backend
cp backend/config/config.local.example.php backend/config/config.local.php
# → DB-Credentials und API-Keys eintragen

# Claude Code Permissions
cp .claude/settings.local.json.example .claude/settings.local.json
# → Projekt-spezifische Permissions ergänzen
```

### 4. Dokumentation anpassen

1. `CLAUDE.md` — Projekt-Übersicht, Build-Commands, Architektur anpassen
2. `docs/PRD.md` — Anforderungen, Architektur, NFR ausfüllen
3. `docs/Roadmap.md` — Feature-Roadmap definieren
4. `docs/features/` — Erste Features spezifizieren

### 5. Git konfigurieren

```bash
git add .
git commit -m "Initial setup from starterkit_PHP_mysql_android"
```

## Skills (Slash-Commands)

| Skill | Befehl | Beschreibung |
|-------|--------|-------------|
| Architekt | `/architect` | Systemdesign, technische Entscheidungen |
| Backend-Dev | `/backend-dev` | PHP API & Admin-Portal Entwicklung |
| Frontend-Dev | `/frontend-dev` | Android Compose & Web-Templates |
| Deploy | `/deploy` | Build, Versionierung, Deployment |
| QA-Check | `/qa-check` | Qualitätssicherung & Testing |
| Pentest | `/pentest` | Security Penetration Testing |
| Requirements | `/requirements` | Anforderungsanalyse & User Stories |
| UX-Review | `/ux-review` | Seniorengerechte Benutzerführung |
| User Journeys | `/user-journeys` | UX-Flows & Journey Mapping |

## Hooks

| Hook | Event | Funktion |
|------|-------|----------|
| protect-sensitive-files | PreToolUse | Blockiert Zugriff auf Credentials |
| block-destructive-commands | PreToolUse | Blockiert `rm -rf`, `git push --force`, etc. |
| schema-guard | PreToolUse | Bestätigung bei Schema-Änderungen |
| feature-docs-reminder | PostToolUse | Erinnert an Feature-Docs-Update |
| compact-context | SessionStart | Re-injiziert Kontext nach Compaction |
| notify-windows | Notification | Windows-Toast bei Idle |

## Voraussetzungen

- **PHP 7.4+** mit MySQL
- **Android Studio** mit SDK 35
- **Claude Code** CLI
- **jq** (für Hooks): `choco install jq` (Windows) / `brew install jq` (macOS)
