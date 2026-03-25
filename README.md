# Starterkit: PHP + MySQL + Android

Ein **Claude Code Starterkit** für Projekte mit PHP-Backend und Android-App. Enthält bewährte Konfigurationen, Skills, Hooks und Dokumentationsstrukturen.

## Was ist enthalten?

### Claude Code Konfiguration (`.claude/`)

| Bereich | Dateien | Beschreibung |
|---------|---------|-------------|
| **Skills** | `.claude/skills/` | 12 spezialisierte Skills (siehe unten) — manuell via `/skill` aufrufbar und automatisch via Kontext ladbar |
| **Rules** | `.claude/rules/` | Clean Code, Feature-Docs, Release-Naming, Version-Bump, Database-Migration |
| **Hooks** | `.claude/hooks/` | Sensitive-File-Schutz, Destruktive-Befehle-Blocker, Schema-Guard, Feature-Docs-Reminder, Compact-Context, Windows-Notification |
| **Settings** | `.claude/settings.json` | Hooks-Konfiguration, media-pipeline Plugin |
| **Launch** | `.claude/launch.json` | PHP Dev-Server Konfiguration |

### Dokumentationsstruktur (`docs/`)

| Bereich | Dateien | Beschreibung |
|---------|---------|-------------|
| **PRD** | `docs/PRD.md` | Product Requirements Document (Architektur, NFR, Versionshistorie) |
| **Roadmap** | `docs/Roadmap.md` | Produkt-Roadmap (getrennt von PRD für besseren Context) |
| **Features** | `docs/features/` | Feature-Spezifikationen mit User Stories und Akzeptanzkriterien |
| **DevDocs** | `docs/devdocs/` | Testfälle (UT/IT/E2E), Traceability Matrix |
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

## Skills

Alle Skills liegen unter `.claude/skills/<name>/SKILL.md` und sind sowohl manuell (`/skill`) als auch automatisch (Kontext-basiert) ladbar.

### Design & Planung

| Skill | Befehl | Beschreibung |
|-------|--------|-------------|
| UX Discovery | `/ux-discovery` | Problemverständnis, Personas, Journey Maps, Wireframes |
| Requirements | `/requirements` | Anforderungsanalyse, User Stories, Akzeptanzkriterien |
| Architekt | `/architect` | Systemdesign, technische Entscheidungen |

### Implementierung

| Skill | Befehl | Beschreibung |
|-------|--------|-------------|
| Backend-Dev | `/backend-dev` | PHP API & Admin-Portal Entwicklung |
| Frontend-Dev | `/frontend-dev` | Android Compose & Web-Templates |
| Deploy | `/deploy` | Build, Versionierung, Deployment |

### Qualitätssicherung

| Skill | Befehl | Beschreibung |
|-------|--------|-------------|
| QA-Check | `/qa-check` | Code-Qualität, Testausführung, Regressionen |
| QA-Test-Run | `/qa-test-run` | Automatisierte Tests implementieren & ausführen |
| UX-Review | `/ux-review` | UI-Validierung gegen Wireframes |
| Pentest | `/pentest` | Security Penetration Testing |
| User Journeys | `/user-journeys` | UX-Flows & Journey Mapping |

### Marketing

| Skill | Befehl | Beschreibung |
|-------|--------|-------------|
| Product Marketing Context | `/product-marketing-context` | Zentrales Marketing-Kontextdokument |

## Entwicklungs-Pipeline (18 Schritte)

```
Design & Planung          → /ux-discovery → /requirements → /qa-test-cases → /architect
Implementierung           → /backend-dev → /frontend-dev → /qa-test-run
Qualitätssicherung        → /ux-review → /qa-check
Staging & Abnahme         → /deploy staging → UAT
Produktion & Release      → /deploy production → /deploy release → /pentest
Post-Release              → /qa-test-run (Regression) → Roadmap-Bereinigung
```

Details: siehe `.claude/rules/feature-docs.md`

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
